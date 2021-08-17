<?php


namespace App\Services;


use App\Contracts\AuthContract;
use App\Models\User;
use Illuminate\Http\Client\Request;

class AuthService implements AuthContract
{
    public function login($request)
    {
        $credentials = request(['username', 'password']);
        $token = auth()->attempt($credentials);
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
