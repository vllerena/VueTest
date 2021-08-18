<?php

namespace App\Rules\Traits;

use App\Models\Info\RoleAttr;
use App\Models\Info\UserAttr;
use Illuminate\Validation\Rule;

trait UserRules
{
    public function nameRules($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255', 'min:3'];
    }

    public function usernameRules($user, $required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        $unique = Rule::unique(UserAttr::TABLE_NAME, UserAttr::USERNAME);
        $unique = $user ? $unique->ignore($user[UserAttr::ID]) : $unique;
        return [$required, $unique, 'string', 'max:100', 'min:3'];
    }

    public function usernamesRules($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:100', 'min:3'];
    }

    public function passwordRules($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:50', 'min:5'];
    }

    public function rolRules($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, Rule::exists(RoleAttr::TABLE_NAME, RoleAttr::ID)];
    }

    public function userAttrsNames()
    {
        return [
            UserAttr::NAME => 'name',
            UserAttr::USERNAME => 'username',
            UserAttr::PASSWORD => 'password',
            UserAttr::ROLE_ID => 'role',
        ];
    }
}
