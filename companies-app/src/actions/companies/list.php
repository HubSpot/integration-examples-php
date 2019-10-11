<?php

use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();

// https://developers.hubspot.com/docs/methods/companies/get-all-companies
$companies = $hubSpot->companies()->all([
    'properties' => ['name', 'domain'],
])->getData()->companies;

include __DIR__.'/../../views/companies/list.php';
