<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CustomController::class, 'getDashboard'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [CustomController::class, 'profile'])->name('profile');
    Route::post('profile', [CustomController::class, 'saveProfile']);
    Route::post('/profileImageDelete/{id}', [CustomController::class, 'profileImageDelete']);
    Route::get('changePassword', [CustomController::class, 'changePassword'])->name('changePassword');
    Route::post('/changePasswordSave', [CustomController::class, 'saveChangePassword']);
});

Route::get('/login/{social}', [SocialiteController::class, 'socialLogin']);
Route::get('/login/{social}/callback', [SocialiteController::class, 'handleProviderCallback']);

//Admin
Route::middleware(['auth', 'admin'])->group(
    function () {
        Route::get('usersList', [AdminController::class, 'usersList']);
        Route::get('user', [AdminController::class, 'user']);
        Route::post('userSave', [AdminController::class, 'userSave']);
        Route::get('userView/{id}', [AdminController::class, 'userView']);
        Route::post('userDelete/{id}', [AdminController::class, 'userDelete']);
        Route::post('/userImageDelete/{id}', [AdminController::class, 'userImageDelete']);
    }
);

require __DIR__ . '/auth.php';
