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
    return view('page.homepage');
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


Route::middleware(['admin'])->group(
    function ()
        {
            //Tournament
            Route::get('/list-tournament', 'App\Http\Controllers\Admin\TournamentController@index')->name('tournament.index');
            Route::get('/create-tournament', 'App\Http\Controllers\Admin\TournamentController@create')->name('tournament.create');
            Route::post('/store-tournament', 'App\Http\Controllers\Admin\TournamentController@store')->name('tournament.store');
            Route::get('/tournament/{id}', 'App\Http\Controllers\Admin\TournamentController@show')->name('tournament.show');
            Route::get('/edit-tournament/{id}', 'App\Http\Controllers\Admin\TournamentController@edit')->name('tournament.edit');
            Route::post('/update-tournament/{id}', 'App\Http\Controllers\Admin\TournamentController@update')->name('tournament.update');


            //Team
            Route::get('/list-team', 'App\Http\Controllers\Admin\TeamController@index')->name('team.index');
            Route::get('/create-team', 'App\Http\Controllers\Admin\TeamController@create')->name('team.create');
            Route::post('/store-team', 'App\Http\Controllers\Admin\TeamController@store')->name('team.store');
            Route::get('/team/{id}', 'App\Http\Controllers\Admin\TeamController@show')->name('team.show');
            Route::get('/edit-team/{id}', 'App\Http\Controllers\Admin\TeamController@edit')->name('team.edit');
            Route::post('/update-team/{id}', 'App\Http\Controllers\Admin\TeamController@update')->name('team.update');


            //Player
            Route::get('/list-player', 'App\Http\Controllers\Admin\PlayerController@index')->name('player.index');
            Route::get('/create-player', 'App\Http\Controllers\Admin\PlayerController@create')->name('player.create');
            Route::post('/store-player', 'App\Http\Controllers\Admin\PlayerController@store')->name('player.store');
            Route::get('/player/{id}', 'App\Http\Controllers\Admin\PlayerController@show')->name('player.show');
            Route::get('/edit-player/{id}', 'App\Http\Controllers\Admin\PlayerController@edit')->name('player.edit');
            Route::post('/update-player/{id}', 'App\Http\Controllers\Admin\PlayerController@update')->name('player.update');

            //Schedule
            Route::get('/list-schedule', 'App\Http\Controllers\Admin\ScheduleController@index')->name('schedule.index');
            Route::get('/create-schedule', 'App\Http\Controllers\Admin\ScheduleController@create')->name('schedule.create');
            Route::post('/store-schedule', 'App\Http\Controllers\Admin\ScheduleController@store')->name('schedule.store');
            Route::get('/schedule/{id}', 'App\Http\Controllers\Admin\ScheduleController@show')->name('schedule.show');
            Route::get('/edit-schedule/{id}', 'App\Http\Controllers\Admin\ScheduleController@edit')->name('schedule.edit');
            Route::post('/update-schedule/{id}', 'App\Http\Controllers\Admin\ScheduleController@update')->name('schedule.update');
            Route::get('/result', 'App\Http\Controllers\Admin\ScheduleController@result')->name('schedule.result');

        });
