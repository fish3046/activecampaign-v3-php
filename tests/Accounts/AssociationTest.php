<?php

namespace Jetimob\ActiveCampaign\Tests\Accounts;

use Jetimob\ActiveCampaign\Http\Accounts\Accounts;
use Jetimob\ActiveCampaign\Http\Accounts\Association;
use Jetimob\ActiveCampaign\Http\Contacts\Contacts;
use Jetimob\ActiveCampaign\Tests\ResourceTestCase;

class AssociationTest extends ResourceTestCase
{
    protected static $contact = [
        'email' => 'wearetesting@mailinator.com',
        'firstName' => 'Weare',
        'lastName' => 'Testing',
    ];
    protected static $account = [
        'name' => 'Xesque',
        'accountUrl' => 'https://jetimob.com',
    ];

    protected static $jobTitle = 'Pica';

    public function testAssociation()
    {
        $contacts = new Contacts($this->client);
        $contact = $contacts->create(static::$contact);

        $accounts = new Accounts($this->client);
        $account = $accounts->create(static::$account);

        $association = new Association($this->client);

        $createdAassociation = $association->create([
            'contact' => $contact['contact']['id'],
            'account' => $account['account']['id'],
            'jobTitle' => static::$jobTitle,
        ]);

        $this->assertEquals(1, count($createdAassociation));

        $getAccount = $association->get($createdAassociation['accountContact']['id']);
        $this->assertEquals(self::$jobTitle, $getAccount['accountContact']['jobTitle']);

        $deleteAssociation = $association->delete((int) $createdAassociation['accountContact']['id']);
        $this->assertEquals(true, $deleteAssociation);

        $deleteAccount = $accounts->delete((int) $account['account']['id']);
        $this->assertEquals(true, $deleteAccount);

        $deleteContact = $contacts->delete((int) $contact['contact']['id']);
        $this->assertEquals(true, $deleteContact);

    }
}
