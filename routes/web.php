<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    return view('index');
});

Route::get('photos', [PhotoController::class, 'indexWebView'])->middleware('auth.basic');

Route::post('login', [LoginController::class, 'login']);
Route::get('login', [LoginController::class, 'loginView']);
Route::get('logout', [LoginController::class, 'logout']);
Route::post('register', [LoginController::class, 'register']);
Route::get('register', [LoginController::class, 'registerView']);

Route::group(['prefix' => 'config'], function () {
    Route::get('isUserLoggedIn', [ConfigurationController::class, 'checkIfUserIsLoggedIn']);
});

Route::get('/public/photo/{photoName}', function ($photoName) {
    return response()->file(Storage::disk('local')->path($photoName));
})->name('photos.serve');