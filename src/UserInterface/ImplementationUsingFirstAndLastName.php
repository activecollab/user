<?php

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait ImplementationUsingFirstAndLastName
{
    use FormatNameImplementation;

    /**
     * Return full name of this user
     *
     * @return string
     */
    public function getFullName()
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }

    /**
     * Return email address of a given user
     *
     * @return string
     */
    abstract public function getEmail();
}
