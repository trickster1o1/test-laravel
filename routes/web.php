<?php

use App\Http\Controllers\Admin\UserController;
use App\Models\Frontend\UserPetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::controller(UserController::class)->group(function() {
    Route::post('/login','userLogin')->name('user.login');
});

Route::controller(UserPetController::class)->group(function() {
    Route::get('/user-pet/index1','index')->name('userPet.index');
});