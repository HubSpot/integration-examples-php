<?php

use Helpers\HubspotClientHelper;

$hubSpot = HubspotClientHelper::createFactory();

extract($_SESSION['FORM']);

include __DIR__.'/../../views/forms/form.php';
