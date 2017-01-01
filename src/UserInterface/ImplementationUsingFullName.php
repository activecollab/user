<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\HumanNameParser\Parser as HumanNameParser;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait ImplementationUsingFullName
{
    use FormatNameImplementation, UserIsImplementation;

    /**
     * @var array|null
     */
    private $full_name_bits;

    /**
     * {@inheritdoc}
     */
    public function getFirstName(): ?string
    {
        return $this->getFullNameBit('first');
    }

    /**
     * Return first name bit.
     *
     * @param  string $bit
     * @return string
     */
    private function getFullNameBit($bit)
    {
        if (empty($this->full_name_bits)) {
            $full_name = $this->getFullName();

            if (empty($full_name)) {
                list($first_name, $last_name) = $this->getFirstAndLastNameFromEmail();

                if ($first_name && $last_name) {
                    $this->full_name_bits = (new HumanNameParser("$first_name $last_name"))->getArray();
                } else {
                    $this->full_name_bits = ['first' => $first_name];
                }
            } else {
                $this->full_name_bits = (new HumanNameParser($full_name))->getArray();
            }
        }

        return empty($this->full_name_bits[$bit]) ? '' : $this->full_name_bits[$bit];
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName(): ?string
    {
        return $this->getFullNameBit('last');
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getFullName(): ?string;
}
