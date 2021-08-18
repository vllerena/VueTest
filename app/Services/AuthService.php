<?php


namespace App\Services;


use App\Contracts\AuthContract;
use App\Models\Info\UserAttr;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;

class AuthService implements AuthContract
{
    public function login($request)
    {
        $credentials = request(['username', 'password']);
        $user = User::where(UserAttr::USERNAME, 'LIKE', $credentials['username'])->firstOrFail();
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
        ]);
    }
}
