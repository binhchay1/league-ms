<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layout.admin_layout');
    })->name('dashboard');
});

Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

//Tournament
Route::get('/list-tournament', 'App\Http\Controllers\Admin\TournamentController@index')->name('tournament.index');
Route::get('/create-tournament', 'App\Http\Controllers\Admin\TournamentController@create')->name('tournament.create');
Route::post('/store-tournament', 'App\Http\Controllers\Admin\TournamentController@store')->name('tournament.store');
Route::get('/tournament/{id}', 'App\Http\Controllers\Admin\TournamentController@show')->name('tournament.show');
Route::get('/edit-tournament/{id}', 'App\Http\Controllers\Admin\TournamentController@edit')->name('tournament.edit');
Route::post('/update-tournament/{id}', 'App\Http\Controllers\Admin\TournamentController@update')->name('tournament.update');
