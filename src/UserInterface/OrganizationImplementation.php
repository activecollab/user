<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\OrganizationInterface;
use ActiveCollab\User\UserInterface;

trait OrganizationImplementation
{
    private $organization;

    public function getOrganization(): ?OrganizationInterface
    {
        return $this->organization;
    }

    /**
     * @param  OrganizationInterface|null $organization
     * @return UserInterface|$this
     */
    public function &setOrganization(OrganizationInterface $organization = null): UserInterface
    {
        $this->organization = $organization;

        return $this;
    }
}
