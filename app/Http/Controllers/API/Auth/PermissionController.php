<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Info\RoleAttr;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function filterPermission()
    {
//        return Role::where(RoleAttr::ID, $request->id)->firstOrFail();
    }

    public function createPermission(Request $request)
    {
        return Role::where(RoleAttr::ID, $request->id)->update([
            RoleAttr::PERMISSION => $request->permission
        ]);
    }
}
