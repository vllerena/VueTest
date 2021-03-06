<?php

namespace App\Console\Commands;

use App\Models\Info\RoleAttr;
use App\Models\Info\UserAttr;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperuser extends Command
{
    protected $signature = 'make:superuser {name} {username} {password}';
    protected $description = 'Crear un superusuario o actualiza acorde a un username y password';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $args = $this->arguments();
        $name = $args['name'];
        $username = $args['username'];
        $password = $args['password'];

        $roles = RoleAttr::roles();
        foreach ($roles as $k => $v)
            Role::updateOrCreate(
            [RoleAttr::NAME => $v],
            [
                RoleAttr::NAME => $v,
            ]
        );

        User::updateOrCreate(
            [UserAttr::USERNAME => $username],
            [
                UserAttr::NAME => $name,
                UserAttr::USERNAME => $username,
                UserAttr::PASSWORD => Hash::make($password),
                UserAttr::IS_SUPERUSER => true,
                UserAttr::IS_ACTIVE => true,
                UserAttr::ROLE_ID => 1,
            ]
        );

        $this->info("Se ha actualizado o creado el usuario.");

        return 0;
    }
}
