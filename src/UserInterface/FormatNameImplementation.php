<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\UserInterface;

trait FormatNameImplementation
{
    public function formatName(string $format = UserInterface::NAME_FULL): string
    {
        $first_name = $this->getFirstName();
        $last_name = $this->getLastName();

        if (empty($first_name) && empty($last_name)) {
            list($first_name, $last_name) = $this->getFirstAndLastNameFromEmail();
        }

        if ($format == UserInterface::NAME_FULL) {
            return trim($first_name . ' ' . $last_name);
        } else {
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
     * Try to get first and last name from email address.
     *
     * @return array
     */
    public function getFirstAndLastNameFromEmail()
    {
        $exploded_full_name = explode(' ', str_replace(['.', '-', '_'], [' ', ' ', ' '], substr($this->getEmail(), 0, strpos($this->getEmail(), '@'))));

        if (count($exploded_full_name) === 1) {
            $first_name = mb_strtoupper(mb_substr($exploded_full_name[0], 0, 1)) . mb_substr($exploded_full_name[0], 1);
            $last_name = '';
        } else {
            $full_name = [];

            foreach ($exploded_full_name as $k) {
                $full_name[] = mb_strtoupper(mb_substr($k, 0, 1)) . mb_substr($k, 1);
            }

            $first_name = array_shift($full_name);
            $last_name = implode(' ', $full_name);
        }

        return [$first_name, $last_name];
    }

    abstract public function getEmail(): string;
    abstract public function getFirstName(): ?string;
    abstract public function getLastName(): ?string;
}
