<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\Test\Fixtures;

use ActiveCollab\User\OrganizationInterface;
use ActiveCollab\User\UserInterface;
use ActiveCollab\User\UserInterface\ImplementationUsingFirstAndLastName as UserInterfaceImplementation;
use InvalidArgumentException;

/**
 * @package ActiveCollab\User\Test\Fixtures
 */
class FirstLastNameUser implements UserInterface
{
    use UserInterfaceImplementation;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var
     */
    private $last_name;

    /**
     * @var string
     */
    private $email;

    /**
     * @param string     $first_name
     * @param string     $last_name
     * @param string     $email
     * @param bool|false $validate_email_format
     */
    public function __construct($first_name, $last_name, $email, $validate_email_format = false)
    {
        if (empty($email)) {
            throw new InvalidArgumentException("Value '$email' is not a valid email address");
        }

        if ($validate_email_format && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Value '$email' is not a valid email address");
        }

        $this->first_name = empty($first_name) ? '' : $first_name;
        $this->last_name = empty($last_name) ? '' : $last_name;
        $this->email = $email;
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
     * {@inheritdoc}
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getOrganization(): ?OrganizationInterface
    {
        return null;
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
