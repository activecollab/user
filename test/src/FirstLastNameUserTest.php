<?php

namespace ActiveCollab\User\Test;

use ActiveCollab\User\Test\Fixtures\FirstLastNameUser;
use ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\Test
 */
class FirstLastNameUserTest extends TestCase
{
    /**
     * Test if full name is optional
     */
    public function testFullNameIsOptional()
    {
        new FirstLastNameUser('', '', 'bill@microsoft.com');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmailIsRequired()
    {
        new FirstLastNameUser('William', 'Gates', '');
    }

    /**
     * Test if we can provide an invalid email by default
     */
    public function testEmailIsNotValidatedByDefault()
    {
        new FirstLastNameUser('Edwin', 'van der Sar', 'not valid email address');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmailCanBeValidated()
    {
        new FirstLastNameUser('Edwin', 'van der Sar', 'not valid email address', true);
    }

    /**
     * Test Edwin van der Sar
     */
    public function testEdwinVanDerSar()
    {
        $edwin = new FirstLastNameUser('Edwin', 'van der Sar', 'edwin@example.com');

        $this->assertEquals('Edwin', $edwin->getFirstName());
        $this->assertEquals('van der Sar', $edwin->getLastName());
    }

    /**
     * Test Charles de Batz-Castelmore d'Artagnan
     */
    public function testCharlesDeBatzCCastelmoreDArtagnan()
    {
        $charles = new FirstLastNameUser("Charles", "d'Artagnan", 'charles@example.com');

        $this->assertEquals('Charles', $charles->getFirstName());
        $this->assertEquals("d'Artagnan", $charles->getLastName());
    }

    /**
     * Test Bill Gates
     */
    public function testBillGates()
    {
        $bill = new FirstLastNameUser('William', 'Gates', 'bill@microsoft.com');

        $this->assertEquals('William', $bill->getFirstName());
        $this->assertEquals('Gates', $bill->getLastName());
    }

    /**
     * Test if first name is extracted from personal bit of email address, when available
     */
    public function testPersonalBitOfEmailIsUsedWhenFullNameIsNotProvided()
    {
        $bill = new FirstLastNameUser('', '', 'bill.gates@microsoft.com');

        $this->assertEquals('', $bill->getFirstName());
        $this->assertEquals('', $bill->getLastName());
        $this->assertEquals('Bill Gates', $bill->formatName(UserInterface::NAME_FULL));

        $steve = new FirstLastNameUser('', '', 'steve@apple.com');

        $this->assertEquals('', $steve->getFirstName());
        $this->assertEquals('', $steve->getLastName());
        $this->assertEquals('Steve', $steve->formatName(UserInterface::NAME_FULL));
    }
}
