<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\Test;

use ActiveCollab\User\UnidentifiedVisitor;

/**
 * @package ActiveCollab\User\Test
 */
class UnidentifiedVisitorTest extends TestCase
{
    public function testUnidentifiedVistorEmail()
    {
        $this->assertContains('example.com', (new UnidentifiedVisitor())->getEmail());
    }

    public function testUnidentifiedVistorName()
    {
        $this->assertEquals('Unidentified Visitor', (new UnidentifiedVisitor())->getFullName());
    }
}
