<?php

namespace ActiveCollab\User\Test;

use ActiveCollab\User\AnonymousUser;

/**
 * @package ActiveCollab\User\Test
 */
class AnonymousUserTest extends TestCase
{
    /**
     * Test if full name is optional
     */
    public function testFullNameIsOptional()
    {
        new AnonymousUser('', 'bill@microsoft.com');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmailIsRequired()
    {
        new AnonymousUser('William Henry "Bill" Gates III', '');
    }

    /**
     * Test if we can provide an invalid email by default
     */
    public function testEmailIsNotValidatedByDefault()
    {
        new AnonymousUser('Edwin van der Sar', 'not valid email address');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmailCanBeValidated()
    {
        new AnonymousUser('Edwin van der Sar', 'not valid email address', true);
    }

    /**
     * Test Edwin van der Sar
     */
    public function testEdwinVanDerSar()
    {
        $edwin = new AnonymousUser('Edwin van der Sar', 'edwin@example.com');

        $this->assertEquals('Edwin', $edwin->getFirstName());
        $this->assertEquals('van der Sar', $edwin->getLastName());
    }

    /**
     * Test Charles de Batz-Castelmore d'Artagnan
     */
    public function testCharlesDeBatzCCastelmoreDArtagnan()
    {
        $charles = new AnonymousUser("Charles de Batz-Castelmore d'Artagnan", 'charles@example.com');

        $this->assertEquals('Charles', $charles->getFirstName());
        $this->assertEquals("d'Artagnan", $charles->getLastName());
    }

    /**
     * Test Bill Gates
     */
    public function testBillGates()
    {
        $bill = new AnonymousUser('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $this->assertEquals('William', $bill->getFirstName());
        $this->assertEquals('Gates', $bill->getLastName());
    }

    /**
     * Test if first name is extracted from personal bit of email address, when available
     */
    public function testPersonalBitOfEmailIsUsedWhenFullNameIsNotProvided()
    {
        $bill = new AnonymousUser('', 'bill.gates@microsoft.com');

        $this->assertEquals('Bill', $bill->getFirstName());
        $this->assertEquals('Gates', $bill->getLastName());

        $steve = new AnonymousUser('', 'steve@apple.com');

        $this->assertEquals('Steve', $steve->getFirstName());
        $this->assertEquals('', $steve->getLastName());
    }

    /**
     * Test JSON serialize
     */
    public function testJsonSerialize()
    {
        $bill = new AnonymousUser('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $result = json_decode(json_encode($bill), true);

        $this->assertInternalType('array', $result);
        $this->assertEquals(0, $result['id']);
        $this->assertEquals(AnonymousUser::class, $result['class']);
        $this->assertEquals('William', $result['first_name']);
        $this->assertEquals('Gates', $result['last_name']);
        $this->assertEquals('William Henry "Bill" Gates III', $result['full_name']);
        $this->assertEquals('bill@microsoft.com', $result['email']);
    }
}
