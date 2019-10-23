<?php 

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

        $I->fillField('#username','tanas@smart-it.io');
        $I->fillField('#password','Tanas123');
        $I->click('#loginBtn');

        $I->waitForText('Tanas-dev');
        $I->click('Tanas-dev');

        $I->waitForText('Cool Robot');
    }
}

