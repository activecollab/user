<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User;

use ActiveCollab\User\UserInterface\ImplementationUsingFullName as UserInterfaceImplementation;

/**
 * @package ActiveCollab\User
 */
class UnidentifiedVisitor implements UserInterface
{
    use UserInterfaceImplementation;

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'class' => get_class($this),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'full_name' => $this->getFullName(),
            'email' => $this->getEmail(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName()
    {
        return 'Unidentified Visitor';
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return 'unknown@example.com';
    }
}
