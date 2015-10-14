<?php

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait FormatNameImplementation
{
    /**
     * Return display name of this user
     *
     * @param  string $format
     * @return string
     */
    public function formatName($format = UserInterface::NAME_FULL)
    {
        if ($format == UserInterface::NAME_FULL) {
            return trim($this->getFirstName() . ' ' . $this->getLastName());
        } else {
            $first_name = $this->getFirstName();
            $last_name = $this->getLastName();

            if ($format == UserInterface::NAME_SHORT_LAST_NAME) {
                return $this->getLastName() ? trim($this->getFirstName() . ' ' . mb_substr($this->getLastName(), 0, 1) . '.') : $this->getFirstName();
            } elseif ($format == UserInterface::NAME_SHORT_FIRST_NAME) {
                return $this->getFirstName() ? trim(mb_substr($this->getFirstName(), 0, 1) . '.' . ' ' . $this->getLastName()) : $this->getLastName();
            } else {
                return mb_substr($first_name, 0, 1) . mb_substr($last_name, 0, 1);
            }
        }
    }

    /**
     * Return first name of this user
     *
     * @return string
     */
    abstract public function getFirstName();

    /**
     * Return first name of this user
     *
     * @return string
     */
    abstract public function getLastName();
}