<?php

namespace ActiveCollab\User;

/**
 * @package ActiveCollab\User
 */
interface UserInterface
{
    const NAME_FULL = 'full';
    const NAME_SHORT_LAST_NAME = 'short_last_name';
    const NAME_SHORT_FIRST_NAME = 'short_first_name';
    const NAME_INITIALS = 'initials';

    /**
     * Return user ID
     *
     * @return integer
     */
    public function getId();

    /**
     * Return email address of a given user
     *
     * @return string
     */
    public function getEmail();

    /**
     * Return full name of this user
     *
     * @return string
     */
    public function getFullName();

    /**
     * Return first name of this user
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Return first name of this user
     *
     * @return string
     */
    public function getLastName();

    /**
     * Return display name of this user
     *
     * @param string $format
     */
    public function formatName($format = self::NAME_FULL);
}
