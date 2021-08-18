<?php

use App\Http\Controllers\API\Auth\PermissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('permission')->middleware(['api'])->name('permission.')->group(function () {

    Route::get('', [PermissionController::class, 'filterPermission'])
        ->name('filter');

    Route::post('', [PermissionController::class, 'createPermission'])
        ->name('create');

});
