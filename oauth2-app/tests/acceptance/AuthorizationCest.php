<?php

use \Codeception\Util\Locator;

class AuthorizationCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function authorizeAlertIsDisplayed(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeElement('.alert-error');
        $I->click('.navigation-link');

        $I->waitForElement('#loginBtn');

        $I->fillField('#username', $_ENV['HUBSPOT_LOGIN']);
        $I->fillField('#password', $_ENV['HUBSPOT_PASSWORD']);
        $I->click('#loginBtn');

        $I->waitForText('smart-it');
        $I->click('td>a[href*="'.$_ENV['HUBSPOT_PORTAL_ID'].'"]');

        $I->waitForElement('#contacts-list');
    }
}

