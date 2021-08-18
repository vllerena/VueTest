<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\AuthContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Auth\LoginRequest;
use App\Models\Info\UserAttr;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthContract $authService;

    public function __construct(AuthContract $authService)
    {
        $this->middleware('JWT', ['except' => ['login']]);
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request->validated());
        return response()->json($user);
    }

    public function me()
    {
        return $this->authService->me();
    }

    public function refresh()
    {
        return $this->authService->refresh();
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
