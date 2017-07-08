<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\HumanNameParser\Parser as HumanNameParser;
use Exception;
use InvalidArgumentException;

trait ImplementationUsingFullName
{
    use FormatNameImplementation, JsonSerializeImplementation, OrganizationImplementation, UserIsImplementation;

    private $full_name_bits;

    public function getFirstName(): ?string
    {
        return $this->getFullNameBit('first');
    }

    private function getFullNameBit($first_or_last_name)
    {
        if (!in_array($first_or_last_name, ['first', 'last'])) {
            throw new InvalidArgumentException('First or last name expcected.');
        }

        if (empty($this->full_name_bits)) {
            $full_name = $this->getFullName();

            if (empty($full_name)) {
                list ($first_name, $last_name) = $this->getFirstAndLastNameFromEmail();

                if ($first_name && $last_name) {
                    $this->full_name_bits = (new HumanNameParser("$first_name $last_name"))->getArray();
                } else {
                    $this->full_name_bits = [
                        'first' => $first_name,
                    ];
                }
            } else {
                try {
                    $this->full_name_bits = (new HumanNameParser($full_name))->getArray();
                } catch (Exception $e) {
                    $this->full_name_bits = [
                        'first' => $full_name,
                    ];
                }
            }
        }

        return empty($this->full_name_bits[$first_or_last_name]) ? '' : $this->full_name_bits[$first_or_last_name];
    }

    public function getLastName(): ?string
    {
        return $this->getFullNameBit('last');
    }

    abstract public function getFullName(): ?string;
}
