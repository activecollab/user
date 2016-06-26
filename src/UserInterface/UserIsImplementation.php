<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait UserIsImplementation
{
    /**
     * {@inheritdoc}
     */
    public function is(UserInterface $user)
    {
        return $this->getId() && $this->getId() === $user->getId();
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getId();
}
