<?php
use Helpers\TelegramBotHelper;
use Helpers\HubspotClientHelper;

$user = [
    'firstname' => getValueOrNull('firstname', $_POST),
    'lastname' => getValueOrNull('lastname', $_POST),
    'email' => getValueOrNull('email', $_POST)
];

if (($_SERVER['REQUEST_METHOD'] === 'POST') && (!empty($user['email']))) {
    $hubspot = HubspotClientHelper::createFactoryWithAPIKey();
    $id = $hubspot->contacts()->createOrUpdate($user['email'])->getData()->vid;
    $contact = $hubspot->contacts()->getById(
        $id,
        ['property' => ['email', 'firstname', 'lastname'], 'propertyMode' => 'value_only']
    )->getData();
    $updateProperties = generateUpdateList($contact->properties, $user);
    if (!empty($updateProperties)) {
        $hubspot->contacts()->update($id, $updateProperties);
    }
    $botLink = TelegramBotHelper::generateBotLink($user['email'], $user['firstname'], $user['lastname']);
    include __DIR__ . '/../../views/telegram/url.php';
} else {
    include __DIR__ . '/../../views/telegram/registration.php';
}

function generateUpdateList($properties, array $user): array
{
    $updateProperties = [];
    foreach (['firstname', 'lastname'] as $property) {
        if (empty($properties->$property->value) && !empty($user[$property])) {
            $updateProperties[] = [
                'property' => $property,
                'value' => $user[$property]
            ];
        }
    }
    return $updateProperties;
}
