<?php

class ContactManipulationCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->createContact( 'mike@mailforspam.com');
    }

    public function UpdatePropertiesInvalidData(AcceptanceTester $I)
    {
        $I->fillField(['name' => 'associatedcompanyid'], rand(10000000, getrandmax()) . rand(10000000, getrandmax()));
        $I->click('#save');
        $I->seeElement('.error-wrapper');
    }

    public function UpdatePropertiesValidData(AcceptanceTester $I)
    {
        $I->fillField(['name' => 'company_size'], 71);
        $I->fillField(['name' => 'date_of_birth'], '10.10.2010');
        $I->fillField(['name' => 'firstname'], 'Mike');
        $I->fillField(['name' => 'gender'], 'man');
        $I->fillField(['name' => 'phone'], '+1234566789');
        $I->fillField(['name' => 'city'], 'LAX');
        $I->fillField(['name' => 'state'], 'CA');
        $I->fillField(['name' => 'country'], 'USA');
        $I->click('#save');
        $I->seeElement('.success');
    }

    public function AddingEngagements(AcceptanceTester $I)
    {
        $datetime = (new DateTime())
            ->add(new DateInterval('P1D'));
        $format = 'Y-m-d H:i:s';

        $I->click('#engagementNew');
        $title = 'Hubspot team meeting';

        $I->selectOption(['name' => 'engagement[type]'], 'MEETING');
        $I->fillField(['name' => 'metadata[title]'], $title);
        $I->fillField(['name' => 'metadata[body]'], 'Discussion of Hubspot\'s API');
        $I->fillField(['name' => 'metadata[startTime]'], $datetime->setTime(12, 30)->format($format));
        $I->fillField(['name' => 'metadata[endTime]'], $datetime->setTime(14, 00)->format($format));

        $I->click('#save');

        $I->see($title);
    }

    public function Search(AcceptanceTester $I)
    {
        $I->click('#contactsList');
        $I->submitForm('#SearchForm', ['search'=>'mike@mailforspam.com']);
        $I->see('Mike');
    }
}
