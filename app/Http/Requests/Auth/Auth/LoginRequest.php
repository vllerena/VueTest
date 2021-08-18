<?php

namespace App\Http\Requests\Auth\Auth;

use App\Models\Info\UserAttr;
use App\Rules\Traits\UserRules;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $credentials = $this->getCredentials();
            $user = User::where(UserAttr::USERNAME, 'LIKE', $credentials['username'])->firstOrFail();
            $validCredentials = auth()->login($user);
            if (!$validCredentials)
                $validator->errors()->add(UserAttr::USERNAME, 'El username y/o contraseña ingresados son incorrectos.');
        });
    }

    public function rules()
    {
        return [
            UserAttr::USERNAME => [
                'required',
                Rule::exists(UserAttr::TABLE_NAME)->where(function ($query) {
                    return $query->where(UserAttr::IS_ACTIVE, true);
                })
            ],
            UserAttr::PASSWORD => ['required', 'string',]
        ];
    }

    private function getCredentials()
    {
        $username = $this->input(UserAttr::USERNAME, '');
        $password = $this->input(UserAttr::PASSWORD, '');
        return [UserAttr::USERNAME => $username, UserAttr::PASSWORD => $password];
    }
}
