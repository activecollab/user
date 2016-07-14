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
    public function is($object)
    {
        if ($object instanceof UserInterface) {
            return $this->getId() && $this->getId() === $object->getId();
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getId();
}
