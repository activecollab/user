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
    use FormatNameImplementation;

    /**
     * Return full name of this user.
     *
     * @return string
     */
    public function getFullName()
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }
}
