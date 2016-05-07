<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User;

use ActiveCollab\User\UserInterface\ImplementationUsingFullName as UserInterfaceImplementation;
use InvalidArgumentException;

/**
 * @package ActiveCollab\User
 */
class AnonymousUser implements UserInterface
{
    use UserInterfaceImplementation;

    /**
     * @var string
     */
    private $full_name;

    /**
     * @var string
     */
    private $email;

    /**
     * @param string     $full_name
     * @param string     $email
     * @param bool|false $validate_email_format
     */
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

    /**
     * Serialize user instance.
     *
     * @return array
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
     * Return user ID.
     *
     * @return int
     */
    public function getId()
    {
        return 0;
    }

    /**
     * Return full name of this user.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Return email address of a given user.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
