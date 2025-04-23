<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::get('/users/edit/{id}', 'edit')->name('users.edit');
    Route::delete('/users/destroy/{id}', 'destroy')->name('users.destroy');
});
