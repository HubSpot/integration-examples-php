<?php
use Helpers\HubspotClientHelper;

//$hubSpot = HubspotClientHelper::createFactory();

$hubSpot = \SevenShores\Hubspot\Factory::create('73565ca9-e141-464b-a745-0857380bcc0c');


$type = [
    'name' => getValueOrNull('name', $_POST),
    'headerTemplate' => getValueOrNull('headerTemplate', $_POST),
    'detailTemplate' => getValueOrNull('detailTemplate', $_POST),
    'objectType' => getValueOrNull('objectType', $_POST)
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $responce = $hubSpot->timeline()->createEventType(
        $_ENV['HUBSPOT_APPLICATION_ID'],
        $type['name'],
        $type['headerTemplate'],
        $type['detailTemplate'],
        $type['objectType']
    );
    if (HubspotClientHelper::isResponseSuccessful($responce)) {
        header('Location: /types/show.php?id='.$responce->getData()->id);
    }
}

include __DIR__ . '/../../views/types/form.php';

