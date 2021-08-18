<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\CreateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserContract $userService;

    public function __construct(UserContract $userService)
    {
        $this->middleware('JWT', ['except' => ['login']]);
        $this->userService = $userService;
    }

    public function filterUser(Request $request)
    {
        $users = $this->userService->filterUser($request, 15);
        return response()->json($users);
    }

    public function createUser(CreateUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json($user);
    }
}
