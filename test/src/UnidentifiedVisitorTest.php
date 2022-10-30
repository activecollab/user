<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\Test;

use ActiveCollab\User\UnidentifiedVisitor;

class UnidentifiedVisitorTest extends TestCase
{
    public function testUnidentifiedVisitorEmail(): void
    {
        $this->assertStringContainsString('example.com', (new UnidentifiedVisitor())->getEmail());
    }

    public function testUnidentifiedVisitorName(): void
    {
        $this->assertEquals('Unidentified Visitor', (new UnidentifiedVisitor())->getFullName());
    }
}
