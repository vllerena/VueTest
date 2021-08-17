<?php

namespace App\Contracts;

use App\Http\Requests\Auth\Auth\LoginRequest;
use Illuminate\Http\Client\Request;

interface AuthContract
{
    public function login($request);

    public function me();

    public function refresh();

    public function logout();
}
