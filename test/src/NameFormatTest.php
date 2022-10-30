<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\Test;

use ActiveCollab\User\IdentifiedVisitor;
use ActiveCollab\User\UserInterface;

class NameFormatTest extends TestCase
{
    public function testNameFormat()
    {
        $bill = new IdentifiedVisitor('William Henry "Bill" Gates III', 'bill@microsoft.com');

        $this->assertEquals('William Gates', $bill->formatName());
        $this->assertEquals('William G.', $bill->formatName(UserInterface::NAME_SHORT_LAST_NAME));
        $this->assertEquals('W. Gates', $bill->formatName(UserInterface::NAME_SHORT_FIRST_NAME));
        $this->assertEquals('WG', $bill->formatName(UserInterface::NAME_INITIALS));
    }

    public function testNameFormWhenLastNameIsMissing()
    {
        $bill = new IdentifiedVisitor('', 'bill@microsoft.com');

        $this->assertEquals('Bill', $bill->formatName());
        $this->assertEquals('Bill', $bill->formatName(UserInterface::NAME_SHORT_LAST_NAME));
        $this->assertEquals('B.', $bill->formatName(UserInterface::NAME_SHORT_FIRST_NAME));
        $this->assertEquals('B', $bill->formatName(UserInterface::NAME_INITIALS));
    }
}
