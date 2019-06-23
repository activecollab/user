<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User\UserInterface;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait ImplementationUsingFirstAndLastName
{
    use FormatNameImplementation, JsonSerializeImplementation, OrganizationImplementation, UserIsImplementation;

    public function getFullName(): ?string
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }
}
