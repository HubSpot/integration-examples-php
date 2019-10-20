<?php 

class ContactsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function contactsPageIsDisplayed(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeElement('table.contacts-list');
    }
}
