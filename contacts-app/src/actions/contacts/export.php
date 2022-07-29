<?php

function get_contacts_for_export($properties, $maxPages = 10)
{
    $hubSpot = Helpers\HubspotClientHelper::createFactory();

    $contacts = [];
    $vidOffset = null;
    for ($pageNum = 0; $pageNum < $maxPages; ++$pageNum) {
        // https://developers.hubspot.com/docs/methods/contacts/get_contacts
        $response = $hubSpot->contacts()->all([
            'count' => 10,
            'vidOffset' => $vidOffset,
            'property' => $properties,
        ]);
        foreach ($response->getData()->contacts as $contact) {
            $contacts[] = $contact;
        }
        $vidOffset = $response->getData()->{'vid-offset'};
        $hasMore = $response->getData()->{'has-more'};
        if (!$hasMore) {
            break;
        }
    }

    return $contacts;
}

function generate_csv_rows($contacts, $properties)
{
    $rows = [];
    $headerRow = ['vid'];
    foreach ($properties as $property) {
        $headerRow[] = $property;
    }
    $rows[] = $headerRow;
    foreach ($contacts as $contact) {
        $row = [$contact->vid];
        foreach ($properties as $property) {
            $row[] = $contact->properties->{$property}->value ?? null;
        }
        $rows[] = $row;
    }

    return $rows;
}

$properties = ['email', 'firstname', 'lastname'];

$contacts = get_contacts_for_export($properties);

$csvRows = generate_csv_rows($contacts, $properties);

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=contacts.csv');
$fp = fopen('php://output', 'w');
foreach ($csvRows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);
