<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User;

use ActiveCollab\User\UserInterface\ImplementationUsingFullName as UserInterfaceImplementation;

class UnidentifiedVisitor implements UserInterface
{
    use UserInterfaceImplementation;

    public function getId()
    {
        return 0;
    }

    public function getFullName(): ?string
    {
        return 'Unidentified Visitor';
    }

    public function getEmail(): string
    {
        return 'unknown@example.com';
    }

    public function is($object)
    {
        return false;
    }
}
