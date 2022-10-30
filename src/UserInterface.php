<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\User;

use ActiveCollab\Object\ObjectInterface;
use JsonSerializable;

interface UserInterface extends ObjectInterface, JsonSerializable
{
    const NAME_FULL = 'full';
    const NAME_SHORT_LAST_NAME = 'short_last_name';
    const NAME_SHORT_FIRST_NAME = 'short_first_name';
    const NAME_INITIALS = 'initials';

    public function getEmail(): string;
    public function getFullName(): ?string;
    public function getFirstName(): ?string;
    public function getLastName(): ?string;
    public function getOrganization(): ?OrganizationInterface;
    public function formatName(string $format = self::NAME_FULL);
}
