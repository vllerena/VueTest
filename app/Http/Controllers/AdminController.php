<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        if (!Auth::check() && $request->path() === 'login') {
            return view('welcome');
        }

        if ($request->path() === 'login') {
            return redirect('/');
        }

        $user = Auth::user();
        return $this->checkForPermission($user, $request);
    }

    public function checkForPermission($user, $request)
    {
        $permission = json_decode($user->roles->permission);

        $hasPermission = false;
        if (!$permission) {
            return view('welcome');
        }

        foreach ($permission as $p) {
            if ($p->name == $request->path()) {
                if ($p->read) {
                    $hasPermission = true;
                }
            }
        }
        if ($hasPermission) {
            return view('welcome');
        }

//        return view('welcome');
        return view('404');

    }
}
