<?php

namespace Jetimob\ActiveCampaign\Tests\Accounts;

use Jetimob\ActiveCampaign\Accounts\Accounts;
use Jetimob\ActiveCampaign\Accounts\Association;
use Jetimob\ActiveCampaign\Contacts\Contacts;
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
        $contact = json_decode($contact, true);

        $accounts = new Accounts($this->client);
        $account = $accounts->create(static::$account);
        $account = json_decode($account, true);

        $association = new Association($this->client);

        $create = $association->create([
            'contact' => $contact['contact']['id'],
            'account' => $account['account']['id'],
            'jobTitle' => static::$jobTitle,
        ]);

        $createdAccount = json_decode($create, true);
        $this->assertEquals(1, count($createdAccount));

        $getAccount = $association->get($createdAccount['accountContact']['id']);
        $getAccount = json_decode($getAccount, true);
        $this->assertEquals(self::$jobTitle, $getAccount['accountContact']['jobTitle']);

        $deleteContact = $association->delete($createdAccount['accountContact']['id']);
        $this->assertEquals(true, $deleteContact);
    }
}
