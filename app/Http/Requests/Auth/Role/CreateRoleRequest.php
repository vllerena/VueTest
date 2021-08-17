<?php

namespace App\Http\Requests\Auth\Role;

use App\Models\Info\RoleAttr;
use App\Rules\Traits\RoleRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    use RoleRules;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            RoleAttr::NAME => $this->nameRules(),
            RoleAttr::PERMISSION => $this->permissionRules(),
        ];
    }
}
