<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use App\Models\Role;

interface RoleContract
{
    public function filterRoles(Request $request, $quantity = '*');

    public function createRole(array $data): Role;

    public function showRole(Role $role);

    public function editRole(Role $role, array $data);

    public function destroyRole(Role $role);
}
