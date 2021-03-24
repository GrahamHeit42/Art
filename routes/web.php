<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Artist\ArtistController;

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

Route::get('/admin', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('frontend.register');
    });
    Route::get('/index', function () {
        return view('frontend.index');
    });
    Route::get('/work-single', function () {
        return view('frontend.work-single');
    });
    Route::get('/about', function () {
        return view('frontend.about');
    });
    Route::get('/contact', function () {
        return view('frontend.contact');
    });
});

Route::middleware('auth')->group(function () {
    // All Admin Panel
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profilesave', [AdminController::class, 'saveProfile']);
    Route::get('/changepw', [AdminController::class, 'changepw']);
    Route::post('/changepwsave', [AdminController::class, 'saveChangepw']);

    // Admin
    Route::get('/artist', [AdminController::class, 'insertArtist']);
    Route::get('/artistview/{id}', [AdminController::class, 'viewArtist']);
    Route::post('/artistsave', [AdminController::class, 'saveArtist']);
    Route::post('/artistdlt/{id}', [AdminController::class, 'deleteArtist']);
    Route::get('/artistlist', [AdminController::class, 'allArtists']);

    Route::get('/buyer', [AdminController::class, 'insertBuyer']);
    Route::get('/buyerview/{id}', [AdminController::class, 'viewBuyer']);
    Route::post('/buyersave', [AdminController::class, 'saveBuyer']);
    Route::post('/buyerdlt/{id}', [AdminController::class, 'deleteBuyer']);
    Route::get('/buyerlist', [AdminController::class, 'allBuyers']);

    // Artist
    Route::get('/itemlist', [ArtistController::class, 'itemList']);
    Route::get('/item', [ArtistController::class, 'addItem']);
    Route::post('/itemsave', [ArtistController::class, 'saveItem']);
    Route::get('/itemview/{id}', [ArtistController::class, 'viewItem']);
    Route::post('/itemimgdlt/{id}', [ArtistController::class, 'deleteItemImage']);
    Route::post('/itemdlt/{id}', [ArtistController::class, 'deleteItem']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
