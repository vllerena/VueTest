<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->name('auth.')
    ->group(base_path('routes/api/auth/routes.php'));
