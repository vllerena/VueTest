<?php

use App\Http\Controllers\API\Auth\RoleController;
//use App\Models\Info\ActionAttr;
//use App\Utils\CanUtil;
use Illuminate\Support\Facades\Route;

Route::prefix('role')->middleware(['api'])->name('role.')->group(function () {

        Route::get('', [RoleController::class, 'filterRole'])
        ->name('filter');

        Route::post('', [RoleController::class, 'createRole'])
            ->name('create');

//    Route::get('', [RoleController::class, 'filterRole'])
//        ->middleware([CanUtil::can(ActionAttr::LIST, 'App\Models\Role')])
//        ->name('filter');
//
//    Route::post('', [RoleController::class, 'createRole'])
//        ->middleware([CanUtil::can(ActionAttr::CREATE, 'App\Models\Role')])
//        ->name('create');
//
//    Route::get('{role}', [RoleController::class, 'showRole'])
//        ->middleware([CanUtil::can(ActionAttr::SHOW, 'role')])
//        ->name('show');
//
//    Route::patch('{role}', [RoleController::class, 'editRole'])
//        ->middleware([CanUtil::can(ActionAttr::UPDATE, 'role')])
//        ->name('edit');
//
//    Route::delete('{role}', [RoleController::class, 'destroyRole'])
//        ->middleware([CanUtil::can(ActionAttr::DESTROY, 'role')])
//        ->name('destroy');

});
