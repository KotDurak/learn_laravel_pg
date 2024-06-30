<?php

namespace App\Service;

use App\Models\Role;

class RoleService
{
    public function createRole(string $name)
    {
        return new Role(['name' => $name]);
    }

    public function getDefaultRoles(): array
    {
        return ['admin', 'worker', 'moderator'];
    }
}
