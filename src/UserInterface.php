<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User;

use ActiveCollab\Object\ObjectInterface;
use JsonSerializable;

/**
 * @package ActiveCollab\User
 */
interface UserInterface extends ObjectInterface, JsonSerializable
{
    const NAME_FULL = 'full';
    const NAME_SHORT_LAST_NAME = 'short_last_name';
    const NAME_SHORT_FIRST_NAME = 'short_first_name';
    const NAME_INITIALS = 'initials';

    /**
     * Return email address of a given user.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Return full name of this user.
     *
     * @return string
     */
    public function getFullName();

    /**
     * Return first name of this user.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Return first name of this user.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Return display name of this user.
     *
     * @param string $format
     */
    public function formatName($format = self::NAME_FULL);
}
