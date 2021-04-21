<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Frontend\PostController as FrontPostController;
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

Route::get('dropzone', [CustomController::class, 'dropzone']);
Route::post('dropzone/store', [CustomController::class, 'dropzoneStore'])->name('dropzone.store');

Route::get('/', [CustomController::class, 'getDashboard']);
Route::get('/faq', function () {
    return view('frontend.pages.faq');
});
Route::get('/terms-and-conditions', function () {
    return view('frontend.pages.terms-and-conditions');
});

Route::get('/login/{social}', [SocialiteController::class, 'socialLogin']);
Route::get('/login/{social}/callback', [SocialiteController::class, 'handleProviderCallback']);

//user
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [CustomController::class, 'getDashboard'])->name('dashboard');

    Route::get('profile', [CustomController::class, 'profile'])->name('profile');
    Route::post('profile', [CustomController::class, 'saveProfile']);
    Route::post('/profile-image-delete/{id}', [CustomController::class, 'profileImageDelete']);
    Route::get('change-password', [CustomController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [CustomController::class, 'saveChangePassword']);

    Route::get('artist-personal/create', [FrontPostController::class, 'artistPersonalCreate'])->name('artist-personal');
    Route::get('artist-commissioned/create', [FrontPostController::class, 'artistCommissionedCreate'])->name('artist-commissioned');
    Route::get('commissioner/create', [FrontPostController::class, 'commissionerCreate'])->name('commissioner');

    Route::post('frontside/posts/save', [FrontPostController::class, 'savePost']);
});

//Admin
Route::middleware(['auth', 'admin'])->group(
    function () {
        //users
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create']);
        Route::post('users/save', [UserController::class, 'store']);
        Route::get('users/view/{id}', [UserController::class, 'show']);
        Route::get('users/update/{id}', [UserController::class, 'edit']);
        Route::post('users/delete/{id}', [UserController::class, 'destroy']);
        Route::post('/user-image-delete/{id}', [UserController::class, 'userImageDelete']);
        //posts
        Route::get('posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('posts/create', [PostController::class, 'create']);
        Route::post('posts/save', [PostController::class, 'store']);
        Route::get('posts/view/{id}', [PostController::class, 'show']);
        Route::get('posts/update/{id}', [PostController::class, 'edit']);
        Route::post('posts/delete/{id}', [PostController::class, 'destroy']);

        Route::get('admin/contact-us', [ContactUsController::class, 'index'])->name('admin.contact-us.index');
        Route::post('admin/contact-us/delete/{id}', [ContactUsController::class, 'destroy'])->name('admin.contact-us.delete');
    }
);

require __DIR__ . '/auth.php';
