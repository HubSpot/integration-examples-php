<?php
use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();

$responce = $hubSpot->timeline()->createOrUpdate(
    $_ENV['HUBSPOT_APPLICATION_ID'],
    $_GET['type_id'],
    $_GET['id'],
    $_GET['contact_id']
);
    var_dump($responce->getStatusCode(), $responce->getData());
    exit();
