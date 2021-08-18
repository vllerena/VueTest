<?php


namespace App\Services;

use App\Contracts\UserContract;
use App\Models\Info\RoleAttr;
use App\Models\Info\UserAttr;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService implements UserContract
{
    public function whereFirst($attr, $value, $raise404 = false)
    {
        if ($raise404)
            return User::where($attr, $value)->firstOrFail();
        return User::where($attr, $value)->first();
    }

    public function filterUser(Request $request, $quantity = '*')
    {
        $query = User::orderBy(UserAttr::NAME, 'DESC')->with('roles')->filter($request->all());
        if ($quantity == '*')
            return $query->get();
        return $query->paginate($quantity);
    }

    public function createUser(array $data): User
    {
        $data[UserAttr::PASSWORD] = Hash::make(UserAttr::PASSWORD);
        $user = User::create($data);
//        $this->setRole($data[UserAttr::ROLE_ID], $user);
        return $user;
    }

    public function editUser(User $user, array $data)
    {
        $user->update($data);
        $this->updateRole(Arr::get($data, UserAttr::ROLE_ID), $user);
        return $user;
    }

    public function destroyUser(User $user)
    {
        $this->editUser($user, [UserAttr::IS_ACTIVE => false]);
    }

    private function setRole($roleId, User $user)
    {
//        DB::table(RoleAttr::USER_ROLES)->insert([
//            'user_id' => $user[UserAttr::ID], 'role_id' => $roleId
//        ]);
    }

    private function updateRole($roleId, User $user)
    {
        if ($roleId)
            $this->saveRole($roleId, $user);
    }

    private function saveRole($roleId, User $user)
    {
//        $sameRoleAsBefore = collect($user->roles)->where(RoleAttr::ID, $roleId)->count();
//        if (!$sameRoleAsBefore) {
//            $this->cleanOldRoles($user);
//            DB::table(RoleAttr::USER_ROLES)->insert([
//                'user_id' => $user[UserAttr::ID], 'role_id' => $roleId
//            ]);
//        }
    }

    private function cleanOldRoles(User $user)
    {
//        foreach ($user->roles as $r)
//            DB::table(RoleAttr::USER_ROLES)
//                ->where('role_id', $r[RoleAttr::ID])
//                ->where('user_id', $user[UserAttr::ID])
//                ->delete();
    }
}
