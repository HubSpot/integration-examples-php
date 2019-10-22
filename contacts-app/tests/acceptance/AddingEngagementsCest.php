<?php

class AddingEngagementsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $datetime = (new DateTime())
            ->add(new DateInterval('P1D'));
        $format = 'Y-m-d H:i:s';
        $I->amOnPage('/');
        $I->click('New Contact');
        $I->submitForm('form', ['email' => 'mike@mailforspam.com']);
        $I->see('Successfully updated Contact properties');
        $I->click('Add Engagement');
        $title = 'Hubspot team meeting';
        $I->submitForm('form', [
            'engagement[type]' => 'MEETING',
            'metadata[title]' => $title,
            'metadata[body]' => 'Discussion of Hubspot\'s API',
            'metadata[startTime]' => $datetime->setTime(12, 30)->format($format),
            'metadata[endTime]' => $datetime->setTime(14, 00)->format($format),
        ]);
        $I->see($title);
    }
}
