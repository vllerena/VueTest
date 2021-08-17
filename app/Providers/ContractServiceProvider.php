<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Contracts\RoleContract;
use App\Services\AuthService;
use App\Services\RoleService;
use Carbon\Laravel\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    public $bindings = [
        AuthContract::class => AuthService::class,
        RoleContract::class => RoleService::class,
    ];

    public function register()
    {

    }
}
