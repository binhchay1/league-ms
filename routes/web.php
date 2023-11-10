<?php

use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ProfileController;
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


//homepage
Route::get('/', [HomeController::class, 'viewHome'])->name('home');
Route::get('list-tournaments', [HomeController::class, 'listTour'])->name('list.tour');
Route::get('list-teams', [HomeController::class, 'listTeam'])->name('list.team');

Route::middleware([])->group(function () {
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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('/auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);
Route::get('register', [AuthController::class, 'registerUser'])->name('register_user');
Route::post('register', [AuthController::class, 'storeUser'])->name('storeUser');


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/profile/{nick_name}', [ProfileController::class, 'show'])->name('profile.info');
    Route::get('/user-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/user-profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('/team-manager', [HomeController::class, 'teamManager'])->name('team-manager');
    Route::get('/league-manager', [HomeController::class, 'leagueManager'])->name('league-manager');

    Route::middleware(['admin', 'auth'])->group(
        function () {
            Route::get('dashboard', [AuthController::class, 'dashboard']);
            //User
            Route::get('/list-user', 'App\Http\Controllers\Admin\UserController@index')->name('user.index');
            Route::get('/delete/{id}', 'App\Http\Controllers\Admin\UserController@destroy')->name('user.delete');

            //Sport
            Route::get('/list-sport', 'App\Http\Controllers\Admin\SportController@index')->name('sport.index');
            Route::get('/create-sport', 'App\Http\Controllers\Admin\SportController@create')->name('sport.create');
            Route::post('/store-sport', 'App\Http\Controllers\Admin\SportController@store')->name('sport.store');
            Route::get('/sport/{id}', 'App\Http\Controllers\Admin\SportController@show')->name('sport.show');
            Route::get('/edit-sport/{id}', 'App\Http\Controllers\Admin\SportController@edit')->name('sport.edit');
            Route::post('/update-sport/{id}', 'App\Http\Controllers\Admin\SportController@update')->name('sport.update');

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
        }
    );
});
