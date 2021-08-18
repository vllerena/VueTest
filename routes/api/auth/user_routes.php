<?php

use App\Http\Controllers\API\Auth\UserController;
//use App\Models\Info\ActionAttr;
//use App\Utils\CanUtil;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware(['api'])->name('user.')->group(function () {

        Route::get('', [UserController::class, 'filterUser'])
        ->name('filter');

        Route::post('', [UserController::class, 'createUser'])
        ->name('create');

//    Route::get('', [UserController::class, 'filterUser'])
//        ->middleware([CanUtil::can(ActionAttr::LIST, 'App\Models\User')])
//        ->name('filter');
//
//    Route::post('', [UserController::class, 'createUser'])
//        ->middleware([CanUtil::can(ActionAttr::CREATE, 'App\Models\User')])
//        ->name('create');
//
//    Route::get('{user}', [UserController::class, 'showUser'])
//        ->middleware([CanUtil::can(ActionAttr::SHOW, 'user')])
//        ->name('show');
//
//    Route::patch('{user}', [UserController::class, 'editUser'])
//        ->middleware([CanUtil::can(ActionAttr::UPDATE, 'user')])
//        ->name('edit');
//
//    Route::delete('{user}', [UserController::class, 'destroyUser'])
//        ->middleware([CanUtil::can(ActionAttr::DESTROY, 'user')])
//        ->name('destroy');

});
