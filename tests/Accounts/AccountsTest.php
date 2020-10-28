<?php

namespace Jetimob\ActiveCampaign\Tests\Accounts;

use Jetimob\ActiveCampaign\Accounts\Accounts;
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
        $create = $accounts->create([
            'name' => self::$name,
            'accountUrl' => self::$accountUrl,
        ]);

        $createdAccount = json_decode($create, true);
        $this->assertEquals(1, count($createdAccount));

        $getAccount = $accounts->get($createdAccount['account']['id']);
        $getAccount = json_decode($getAccount, true);
        $this->assertEquals(self::$name, $getAccount['account']['name']);

        $listNotExisting = $accounts->listAll([
            'name' => 'tresque',
        ]);

        $listNotExisting = json_decode($listNotExisting, true);
        $this->assertCount(0, $listNotExisting['accounts']);

        $limitWorking = $accounts->listAll([
            'name' => self::$name
        ], 23, 5);

        $limitWorking = json_decode($limitWorking, true);
        $this->assertCount(0, $limitWorking['accounts']);

        $deleteContact = $accounts->delete($createdAccount['account']['id']);
        $this->assertEquals(true, $deleteContact);
    }
}
