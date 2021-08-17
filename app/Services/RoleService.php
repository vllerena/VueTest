<?php

namespace App\Services;

use App\Contracts\RoleContract;
use App\Models\Info\PermissionAttr;
use App\Models\Info\RoleAttr;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RoleService implements RoleContract
{

    public function filterRoles(Request $request, $quantity = '*')
    {
//        $query = Role::orderBy(RoleAttr::CREATED_AT, 'DESC')->with('permission')->filter($request->all());
        $query = Role::orderBy(RoleAttr::CREATED_AT, 'DESC')->filter($request->all());
        if ($quantity == '*')
            return $query->get();
        return $query->paginate($quantity);
    }

    public function createRole(array $data): Role
    {
        $role = Role::create($data);
//        $this->setPermission($role, $data[RoleAttr::PERMISSION_ATTR]);
        return $role;
    }

    public function showRole(Role $role)
    {
        $query = Role::orderBy(RoleAttr::CREATED_AT, 'DESC')->with('permission')->where(RoleAttr::ID, 'LIKE', $role->id)->firstOrFail();
        return $query;
    }

    public function editRole(Role $role, array $data)
    {
        $role->update($data);
        $this->setPermission($role, Arr::get($data, RoleAttr::PERMISSION_ATTR, []));
        return $role;
    }

    public function destroyRole(Role $role)
    {
        $role->delete();
        return $role;
    }

    private function setPermission(Role $role, $permissionIds)
    {
        if (count($permissionIds)) {
            $this->deletePermissionFromRole($role[RoleAttr::ID]);
            for ($i = 0; $i < count($permissionIds); $i++)
                $this->insertPermission($role[RoleAttr::ID], $permissionIds[$i]);
        }
    }

    private function deletePermissionFromRole($roleId): void
    {
//        DB::table(PermissionAttr::PERMISSIONS_ROLES)
//            ->where('role_id', $roleId)
//            ->delete();
    }

    private function insertPermission($roleId, $permissionId): void
    {
//        DB::table(PermissionAttr::PERMISSIONS_ROLES)->insert([
//            'permission_id' => $permissionId,
//            'role_id' => $roleId
//        ]);
    }
}
