<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\Test\Fixtures;

use ActiveCollab\User\UserInterface;
use ActiveCollab\User\UserInterface\ImplementationUsingFullName as UserInterfaceImplementation;
use InvalidArgumentException;

/**
 * @package ActiveCollab\User\Test\Fixtures
 */
class UserWithAccount implements UserInterface
{
    use UserInterfaceImplementation;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $full_name;

    /**
     * @var string
     */
    private $email;

    /**
     * @param int        $id
     * @param string     $full_name
     * @param string     $email
     * @param bool|false $validate_email_format
     */
    public function __construct($id, $full_name, $email, $validate_email_format = false)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('User ID is required');
        }

        if (empty($email)) {
            throw new InvalidArgumentException("Value '$email' is not a valid email address");
        }

        if ($validate_email_format && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Value '$email' is not a valid email address");
        }

        $this->id = $id;
        $this->full_name = $full_name;
        $this->email = $email;
    }

    /**
     * Return user ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName(): ?string
    {
        return $this->full_name;
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
}
