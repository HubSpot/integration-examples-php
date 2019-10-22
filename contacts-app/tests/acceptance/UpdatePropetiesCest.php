<?php 

class UpdatePropetiesCest
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
        $I->submitForm('form', [
            'company_size' => 71,
            'date_of_birth' => '10.10.2010',
            'gender' => 'man',
            'phone' => '+1234566789',
            'city' => 'LAX',
            'state' => 'CA',
            'country' => 'USA'
        ]);
        $I->see('Successfully updated Contact properties');
    }
}
