<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\OrganizationInterface;

trait JsonSerializeImplementation
{
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'class' => get_class($this),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'full_name' => $this->getFullName(),
            'email' => $this->getEmail(),
            'organization' => $this->getOrganization() ? $this->getOrganization()->getName() : '',
        ];
    }

    abstract public function getId();

    abstract public function getEmail(): string;

    abstract public function getFullName(): ?string;

    abstract public function getFirstName(): ?string;

    abstract public function getLastName(): ?string;

    abstract public function getOrganization(): ?OrganizationInterface;
}
