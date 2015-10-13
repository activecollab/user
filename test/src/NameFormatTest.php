<?php

namespace ActiveCollab\User\Test;

use ActiveCollab\User\AnonymousUser;
use ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\Test
 */
class NameFormatTest extends TestCase
{
    /**
     * @var AnonymousUser
     */
    private $bill;

    /**
     * Set up test environment
     */
    public function setUp()
    {
        parent::setUp();


    }

    public function testNameFormat()
    {
        $bill = new AnonymousUser('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $this->assertEquals('William Gates', $bill->formatName());
        $this->assertEquals('William G.', $bill->formatName(UserInterface::NAME_SHORT_LAST_NAME));
        $this->assertEquals('W. Gates', $bill->formatName(UserInterface::NAME_SHORT_FIRST_NAME));
        $this->assertEquals('WG', $bill->formatName(UserInterface::NAME_INITIALS));
    }

    public function testNameFormWhenLastNameIsMissing()
    {
        $bill = new AnonymousUser('', 'bill@microsoft.com');

        $this->assertEquals('Bill', $bill->formatName());
        $this->assertEquals('Bill', $bill->formatName(UserInterface::NAME_SHORT_LAST_NAME));
        $this->assertEquals('B.', $bill->formatName(UserInterface::NAME_SHORT_FIRST_NAME));
        $this->assertEquals('B', $bill->formatName(UserInterface::NAME_INITIALS));
    }
}
