<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ContactDetailController;
use App\Http\Controllers\Admin\MediumController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\UserController as FrontUserController;
use App\Http\Controllers\Frontend\PostController as FrontPostController;
use Illuminate\Support\Facades\Route;

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

//Route::get('dropzone', [CustomController::class, 'dropzone']);
//Route::post('dropzone/store', [CustomController::class, 'dropzoneStore'])->name('dropzone.store');

// Authentication
// Route::get('/login/{social}', [SocialiteController::class, 'login']);
// Route::get('/login/{social}/callback', [SocialiteController::class, 'callback']);

Route::view('test', 'admin.layouts.app');

// Home Page
Route::get('/', [HomeController::class, 'index']);
Route::post('/mediums', [HomeController::class, 'mediums']);
Route::post('/subjects', [HomeController::class, 'subjects']);

// Posts
Route::post('/posts', [FrontPostController::class, 'index']);
Route::get('/posts/{id}', [FrontPostController::class, 'show']);

// Pages
Route::get('contact-us', [PageController::class, 'contactUs']);
Route::get('about-us', [PageController::class, 'aboutUs']);
Route::get('terms-and-conditions', [PageController::class, 'termsConditions']);
Route::get('help-and-faqs', [PageController::class, 'helpFaqs']);

// Authentication Routes
Route::middleware(['auth'])->group(function () {
    Route::match(['get', 'post'], 'profile', [FrontUserController::class, 'profile']);
    Route::match(['get', 'post'], 'change-password', [FrontUserController::class, 'changePassword']);

    Route::prefix('posts')->group(function () {
        Route::get('create', [FrontPostController::class, 'create']);
        Route::get('store', [FrontPostController::class, 'store']);
    });

//    Route::get('artist-personal/create', [FrontPostController::class, 'artistPersonalCreate'])->name('artist-personal');
//    Route::get('artist-commissioned/create', [FrontPostController::class, 'artistCommissionedCreate'])->name('artist-commissioned');
//    Route::get('commissioner/create', [FrontPostController::class, 'commissionerCreate'])->name('commissioner');
//    Route::post('frontside/posts/save', [FrontPostController::class, 'savePost']);
});

// Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [AdminHomeController::class, 'index']);

    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::post('/', [SubjectController::class, 'getSubjects']);
        Route::get('create', [SubjectController::class, 'show']);
        Route::get('/{id}', [SubjectController::class, 'show']);
        Route::post('store', [SubjectController::class, 'store']);
        Route::post('delete', [SubjectController::class, 'destroy']);
    });

    Route::prefix('mediums')->group(function () {
        Route::get('/', [MediumController::class, 'index']);
        Route::post('/', [MediumController::class, 'getMediums']);
        Route::get('/create', [MediumController::class, 'show']);
        Route::get('/{id}', [MediumController::class, 'show']);
        Route::post('store', [MediumController::class, 'store']);
        Route::post('delete', [MediumController::class, 'destroy']);
    });

    Route::prefix('pages')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'getPages']);
        Route::get('create', [UserController::class, 'create']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('store', [UserController::class, 'store']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'getUsers']);
        Route::get('create', [UserController::class, 'createUpdate']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/edit/{id}', [UserController::class, 'createUpdate']);
        Route::post('store', [UserController::class, 'store']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'getPosts']);
        Route::get('create', [PostController::class, 'create']);
        Route::get('/{id}', [PostController::class, 'show']);
        Route::post('store', [PostController::class, 'store']);
        Route::post('delete', [PostController::class, 'destroy']);
    });

    Route::prefix('contact-details')->group(function () {
        Route::get('/', [ContactDetailController::class, 'index']);
        Route::post('/', [ContactDetailController::class, 'getList']);
        Route::get('/{id}', [ContactDetailController::class, 'show']);
        Route::post('store', [ContactDetailController::class, 'store']);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('store', [SettingController::class, 'store']);
    });
});

require __DIR__ . '/auth.php';
