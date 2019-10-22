<?php 

class CreatingContactsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('New Contact');
        $I->submitForm('form', ['email' => 'mike@mailforspam.com']);
        $I->see('Successfully updated Contact properties');
    }
}
