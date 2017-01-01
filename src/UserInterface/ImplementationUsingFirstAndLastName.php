<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait ImplementationUsingFirstAndLastName
{
    use FormatNameImplementation, UserIsImplementation;

    /**
     * Return full name of this user.
     *
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }
}
