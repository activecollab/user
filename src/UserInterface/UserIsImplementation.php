<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\UserInterface;

trait UserIsImplementation
{
    public function is($object)
    {
        if ($object instanceof UserInterface) {
            return $this->getId() && $this->getId() === $object->getId();
        }

        return false;
    }

    abstract public function getId();
}
