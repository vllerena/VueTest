<?php


namespace App\Contracts;

use Illuminate\Http\Request;
use App\Models\User;

interface UserContract
{
    public function whereFirst($attr, $value);

    public function filterUser(Request $request, $quantity = '*');

    public function createUser(array $data);

    public function editUser(User $user, array $data);

    public function destroyUser(User $user);
}
