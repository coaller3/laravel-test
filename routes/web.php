<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

/* clear cache start */
// Clear all cache:
Route::get('/all-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'All (Application, Routes, Config, View) cache has been cleared';
});
/* clear cache end */

Route::redirect('/', '/login');

Route::get('/login', function () {
    // Log out the user
    Auth::logout();

    // Flush the session data
    session()->flush();

    // Regenerate the session ID
    session()->regenerate();

    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);

Route::middleware('auth')->group(function () {

    // users
    Route::resource('users', UserController::class)->except(['']);
    Route::put('/users/{user}/change_password', [UserController::class, 'change_password']);

    Route::resource('products', ProductController::class)->except(['']);

});
