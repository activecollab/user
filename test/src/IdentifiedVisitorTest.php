<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\Test;

use ActiveCollab\User\IdentifiedVisitor;
use InvalidArgumentException;

class IdentifiedVisitorTest extends TestCase
{
    /**
     * Test if full name is optional.
     */
    public function testFullNameIsOptional()
    {
        $this->expectNotToPerformAssertions();

        new IdentifiedVisitor('', 'bill@microsoft.com');
    }

    public function testEmailIsRequired()
    {
        $this->expectException(InvalidArgumentException::class);

        new IdentifiedVisitor('William Henry "Bill" Gates III', '');
    }

    /**
     * Test if we can provide an invalid email by default.
     */
    public function testEmailIsNotValidatedByDefault()
    {
        $this->expectNotToPerformAssertions();

        new IdentifiedVisitor('Edwin van der Sar', 'not valid email address');
    }

    public function testEmailCanBeValidated()
    {
        $this->expectException(InvalidArgumentException::class);

        new IdentifiedVisitor('Edwin van der Sar', 'not valid email address', true);
    }

    /**
     * Test Edwin van der Sar.
     */
    public function testEdwinVanDerSar()
    {
        $edwin = new IdentifiedVisitor('Edwin van der Sar', 'edwin@example.com');

        $this->assertEquals('Edwin', $edwin->getFirstName());
        $this->assertEquals('van der Sar', $edwin->getLastName());
    }

    /**
     * Test Charles de Batz-Castelmore d'Artagnan.
     */
    public function testCharlesDeBatzCCastelmoreDArtagnan()
    {
        $charles = new IdentifiedVisitor("Charles de Batz-Castelmore d'Artagnan", 'charles@example.com');

        $this->assertEquals('Charles', $charles->getFirstName());
        $this->assertEquals("d'Artagnan", $charles->getLastName());
    }

    /**
     * Test Bill Gates.
     */
    public function testBillGates()
    {
        $bill = new IdentifiedVisitor('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $this->assertEquals('William', $bill->getFirstName());
        $this->assertEquals('Gates', $bill->getLastName());
    }

    /**
     * Test if first name is extracted from personal bit of email address, when available.
     */
    public function testPersonalBitOfEmailIsUsedWhenFullNameIsNotProvided()
    {
        $bill = new IdentifiedVisitor('', 'bill.gates@microsoft.com');

        $this->assertEquals('Bill', $bill->getFirstName());
        $this->assertEquals('Gates', $bill->getLastName());

        $steve = new IdentifiedVisitor('', 'steve@apple.com');

        $this->assertEquals('Steve', $steve->getFirstName());
        $this->assertEquals('', $steve->getLastName());
    }

    public function testOnlyName()
    {
        $steve = new IdentifiedVisitor('Steve', 'bill.gates@microsoft.com');

        $this->assertSame('Steve', $steve->getFirstName());
        $this->assertSame('', $steve->getLastName());
        $this->assertSame('Steve', $steve->getFullName());
    }

    public function testIs()
    {
        $bill = new IdentifiedVisitor('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $this->assertTrue($bill->is($bill));
        $this->assertFalse($bill->is(new \stdClass()));
    }

    public function testJsonSerialize(): void
    {
        $bill = new IdentifiedVisitor('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $result = json_decode(json_encode($bill), true);

        $this->assertIsArray($result);
        $this->assertEquals(0, $result['id']);
        $this->assertEquals(IdentifiedVisitor::class, $result['class']);
        $this->assertEquals('William', $result['first_name']);
        $this->assertEquals('Gates', $result['last_name']);
        $this->assertEquals('William Henry "Bill" Gates III', $result['full_name']);
        $this->assertEquals('bill@microsoft.com', $result['email']);
    }
}
