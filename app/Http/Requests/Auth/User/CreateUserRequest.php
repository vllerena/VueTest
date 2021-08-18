<?php

namespace App\Http\Requests\Auth\User;

use App\Models\Info\UserAttr;
use App\Rules\Traits\UserRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    use UserRules;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            UserAttr::NAME => $this->nameRules(),
            UserAttr::USERNAME => $this->usernamesRules(),
            UserAttr::PASSWORD => $this->passwordRules(),
            UserAttr::ROLE_ID => $this->rolRules(),
        ];
    }
}
