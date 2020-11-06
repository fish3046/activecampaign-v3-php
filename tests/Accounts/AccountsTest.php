<?php

namespace Jetimob\ActiveCampaign\Tests\Accounts;

use Jetimob\ActiveCampaign\Http\Accounts\Accounts;
use Jetimob\ActiveCampaign\Tests\ResourceTestCase;

class AccountsTest extends ResourceTestCase
{
    protected static $name;
    protected static $accountUrl;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$name = 'Xesque';
        self::$accountUrl = 'https://jetimob.com';
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        self::$name = null;
        self::$accountUrl = null;
    }

    public function testContact()
    {
        $accounts = new Accounts($this->client);
        $createdAccount = $accounts->create([
            'name' => self::$name,
            'accountUrl' => self::$accountUrl,
        ]);

        $this->assertEquals(1, count($createdAccount));

        $getAccount = $accounts->get($createdAccount['account']['id']);
        $this->assertEquals(self::$name, $getAccount['account']['name']);

        $deleteContact = $accounts->delete((int) $createdAccount['account']['id']);
        $this->assertEquals(true, $deleteContact);

    }
}
