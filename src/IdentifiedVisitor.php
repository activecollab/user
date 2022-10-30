<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User;

use ActiveCollab\User\UserInterface\ImplementationUsingFullName as UserInterfaceImplementation;
use InvalidArgumentException;

class IdentifiedVisitor implements UserInterface
{
    use UserInterfaceImplementation;

    private $full_name;

    private $email;

    public function __construct($full_name, $email, $validate_email_format = false)
    {
        if (empty($email)) {
            throw new InvalidArgumentException("Value '$email' is not a valid email address");
        }

        if ($validate_email_format && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Value '$email' is not a valid email address");
        }

        $this->full_name = empty($full_name) ? '' : $full_name;
        $this->email = $email;
    }

    public function getId()
    {
        return 0;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function is($object)
    {
        if ($object instanceof UserInterface) {
            return empty($object->getId()) && $this->getEmail() === $object->getEmail();
        }

        return false;
    }
}
