<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::any('/{vue_capture?}', [AdminController::class, 'index'])->where('vue_capture', '[\/\w\.-]*');


//Route::get('/{vue_capture?}', function () {
//    return view('welcome');
//})->where('vue_capture', '[\/\w\.-]*');
