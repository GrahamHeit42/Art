<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
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

// Route::view('test', 'dropzone');
//Route::get('dropzone', [CustomController::class, 'dropzone']);
//Route::post('dropzone/store', [CustomController::class, 'dropzoneStore'])->name('dropzone.store');

// Authentication
// Route::get('/login/{social}', [SocialiteController::class, 'login']);
// Route::get('/login/{social}/callback', [SocialiteController::class, 'callback']);

// Home Page
Route::get('/', [HomeController::class, 'index']);
Route::post('/mediums', [HomeController::class, 'mediums']);
Route::post('/subjects', [HomeController::class, 'subjects']);

// Posts
Route::post('/posts', [FrontPostController::class, 'index']);
Route::get('/posts/{id}', [FrontPostController::class, 'show']);
Route::post('/follow', [FrontPostController::class, 'follow']);

// Pages
Route::match(['get', 'post'], 'contact-us', [PageController::class, 'contactUs']);
Route::get('about-us', [PageController::class, 'aboutUs']);
Route::get('terms-and-conditions', [PageController::class, 'termsConditions']);
Route::get('help-and-faqs', [PageController::class, 'helpFaqs']);

// Authentication Routes
Route::middleware(['auth'])->group(function () {

    Route::match(['get', 'post'], 'profile', [FrontUserController::class, 'profile']);

    Route::match(['get', 'post'], 'settings', [FrontUserController::class, 'settings']);
    Route::match(['get', 'post'], 'change-password', [FrontUserController::class, 'changePassword']);

    Route::prefix('posts')->group(function () {
        Route::get('/create/{type?}', [FrontPostController::class, 'create']);
        // Route::get('create', [FrontPostController::class, 'create']);
        Route::post('store', [FrontPostController::class, 'store']);
    });

    //    Route::get('artist-personal/create', [FrontPostController::class, 'artistPersonalCreate'])->name('artist-personal');
    //    Route::get('artist-commissioned/create', [FrontPostController::class, 'artistCommissionedCreate'])->name('artist-commissioned');
    //    Route::get('commissioner/create', [FrontPostController::class, 'commissionerCreate'])->name('commissioner');
    //    Route::post('frontside/posts/save', [FrontPostController::class, 'savePost']);
});

// Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminHomeController::class, 'index']);

    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::post('/', [SubjectController::class, 'getSubjects']);
        Route::get('create', [SubjectController::class, 'show']);
        Route::post('store', [SubjectController::class, 'store']);
        Route::post('delete', [SubjectController::class, 'destroy']);
        Route::post('delete-image', [SubjectController::class, 'deleteImage']);
        Route::get('/{id}', [SubjectController::class, 'show']);
    });

    Route::prefix('mediums')->group(function () {
        Route::get('/', [MediumController::class, 'index']);
        Route::post('/', [MediumController::class, 'getMediums']);
        Route::get('/create', [MediumController::class, 'show']);
        Route::post('store', [MediumController::class, 'store']);
        Route::post('delete', [MediumController::class, 'destroy']);
        Route::get('/{id}', [MediumController::class, 'show']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'getUsers']);
        Route::get('create', [UserController::class, 'createUpdate']);
        Route::get('/edit/{id}', [UserController::class, 'createUpdate']);
        Route::post('store', [UserController::class, 'store']);
        Route::post('delete', [UserController::class, 'destroy']);
        Route::get('/{id}', [UserController::class, 'show']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'getPosts']);
        Route::get('create', [PostController::class, 'create']);
        Route::post('store', [PostController::class, 'store']);
        Route::post('delete', [PostController::class, 'destroy']);
        Route::get('/{id}', [PostController::class, 'show']);
    });

    /*Route::prefix('contact-details')->group(function () {
        Route::get('/', [ContactDetailController::class, 'index']);
        Route::post('/', [ContactDetailController::class, 'getList']);
        Route::get('/{id}', [ContactDetailController::class, 'show']);
        Route::post('store', [ContactDetailController::class, 'store']);
    });*/

    Route::prefix('pages')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PageController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\PageController::class, 'getPages']);
        // Route::get('create', [\App\Http\Controllers\Admin\PageController::class, 'create']);
        Route::post('store', [\App\Http\Controllers\Admin\PageController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\Admin\PageController::class, 'show']);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('store', [SettingController::class, 'store']);
    });
});

require __DIR__ . '/auth.php';
