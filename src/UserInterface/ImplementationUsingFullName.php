<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\HumanNameParser\Parser as HumanNameParser;

trait ImplementationUsingFullName
{
    use FormatNameImplementation, JsonSerializeImplementation, OrganizationImplementation, UserIsImplementation;

    private $full_name_bits;

    public function getFirstName(): ?string
    {
        return $this->getFullNameBit('first');
    }

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

    public function getLastName(): ?string
    {
        return $this->getFullNameBit('last');
    }

    abstract public function getFullName(): ?string;
}
