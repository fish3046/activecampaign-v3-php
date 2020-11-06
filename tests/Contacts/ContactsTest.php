<?php

namespace Jetimob\ActiveCampaign\Tests\Contacts;

use Jetimob\ActiveCampaign\Http\Contacts\Contacts;
use Jetimob\ActiveCampaign\Tests\ResourceTestCase;

class ContactsTest extends ResourceTestCase
{

    private static $email;
    private static $firstName;
    private static $lastName;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$email = 'wearetesting@mailinator.com';
        self::$firstName = 'Weare';
        self::$lastName = 'Testing';
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        self::$email = null;
        self::$firstName = null;
        self::$lastName = null;
    }

    public function testContact()
    {
        $contacts = new Contacts($this->client);
        $createdContact = $contacts->create([
            'email' => self::$email,
            'firstName' => self::$firstName,
            'lastName' => self::$lastName
        ]);

        $this->assertEquals(1, count($createdContact));

        $getContact = $contacts->get($createdContact['contact']['id']);
        $this->assertEquals(self::$email, $getContact['contact']['email']);

        $deleteContact = $contacts->delete($createdContact['contact']['id']);
        $this->assertEquals(true, $deleteContact);
    }

}
