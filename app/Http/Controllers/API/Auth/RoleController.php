<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\RoleContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Role\CreateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleContract $roleService;

    public function __construct(RoleContract $roleService)
    {
        $this->middleware('JWT', ['except' => ['login']]);
        $this->roleService = $roleService;
    }

    public function filterRole(Request $request)
    {
        $roles = $this->roleService->filterRoles($request, 15);
        return response()->json($roles);
    }

    public function createRole(CreateRoleRequest $request)
    {
        $role = $this->roleService->createRole($request->validated());
        return response()->json($role);
    }
}
