<?php

use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LeagueController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ProductController;
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

Route::middleware(['verified'])->group(function () {
    Route::get('/', [HomeController::class, 'viewHome'])->name('home');
    Route::get('/list-of-league/', [HomeController::class, 'listLeague'])->name('list.league');
    Route::get('/top-league/', [HomeController::class, 'listTopLeague'])->name('top.league');
    Route::post('/search/', [HomeController::class, 'viewSearch'])->name('search.result');
    Route::get('/search/', [HomeController::class, 'viewSearch'])->name('search');
    Route::get('/shop/', [HomeController::class, 'viewShop'])->name('shop');
    Route::get('/about/', [HomeController::class, 'viewAbout'])->name('about');
    Route::get('/privacy/', [HomeController::class, 'viewPrivacy'])->name('privacy');
    Route::get('/term-and-conditions/', [HomeController::class, 'viewTermAndConditions'])->name('term.and.conditions');
    Route::get('/pricing/', [HomeController::class, 'viewPricing'])->name('pricing');
    Route::get('/info/{slug}/', [HomeController::class, 'showInfo'])->name('league.info');
    Route::get('/info/{slug}/player/', [HomeController::class, 'showPlayer'])->name('leaguePlayer.info');
    Route::get('/info/{slug}/result/', [HomeController::class, 'showResult'])->name('leagueResult.info');
    Route::get('/info/{slug}/schedule/', [HomeController::class, 'showSchedule'])->name('leagueSchedule.info');
    Route::get('/info/{slug}/fight-branch/', [HomeController::class, 'showFightBranch'])->name('leagueFightBranch.info');
    Route::get('/list-teams/', [HomeController::class, 'listTeam'])->name('list.team');
    Route::get('/group/', [HomeController::class, 'listGroup'])->name('list.group');
    Route::get('/detail-group/', [HomeController::class, 'detailGroup'])->name('detail.group');
    Route::post('/register-league/', [HomeController::class, 'saveRegisterLeague'])->name('registerLeague');
    Route::get('/ranking/', [HomeController::class, 'viewRanking'])->name('ranking');
    Route::get('/player/{id}/', [HomeController::class, 'viewInforPlayer'])->name('player.info');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/verify/{token}/', [AuthController::class, 'verifyEmail'])->name('user.verify');
    Route::get('/verify-email/', [AuthController::class, 'viewVerifyEmail'])->name('verify.email');
    Route::post('/resend-verify/', [AuthController::class, 'resendVerify'])->name('resend.verify.email');
    Route::get('/verified-email/', [AuthController::class, 'viewVerifiedEmail'])->name('verified.email');
    Route::get('/signout/', [AuthController::class, 'signOut'])->name('signout');

    Route::middleware(['verified'])->group(function () {

        Route::get('/profile/', [AuthController::class, 'profile'])->name('profile');
        Route::get('/my-group/', [AuthController::class, 'viewMyGroup'])->name('my.group');
        Route::get('/join-group/', [AuthController::class, 'joinGroup'])->name('join.group');
        Route::post('/messages/', [AuthController::class, 'sendMessage'])->name('send.message');
    });
});

Route::get('/login/', [AuthController::class, 'login'])->name('login');
Route::post('/custom-login/', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('/auth/google/', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback/', [SocialLoginController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook/', [SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback/', [SocialLoginController::class, 'handleFacebookCallback']);
Route::get('/register/', [AuthController::class, 'registerUser'])->name('register_user');
Route::post('/register/', [AuthController::class, 'storeUser'])->name('storeUser');
Route::get('/setLocale/{locale}/', [HomeController::class, 'changeLocate'])->name('app.setLocale');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile/{nick_name}/', [ProfileController::class, 'show'])->name('profile.info');
    Route::get('/user-profile/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/user-profile/{id}/', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password/', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password/', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('/league-manager/', [HomeController::class, 'leagueManager'])->name('league-manager');

    Route::middleware(['admin', 'auth'])->group(
        function () {
            Route::get('/dashboard/', [AuthController::class, 'dashboard']);

            Route::get('/list-user/', [UserController::class, 'index'])->name('user.index');
            Route::get('/delete/{id}/', [UserController::class, 'destroy'])->name('user.delete');

            Route::get('/list-league/', [LeagueController::class, 'index'])->name('league.index');
            Route::get('/create-league/', [LeagueController::class, 'create'])->name('league.create');
            Route::post('/store-league/', [LeagueController::class, 'store'])->name('league.store');
            Route::get('/league/{id}/', [LeagueController::class, 'show'])->name('league.show');
            Route::get('/edit-league/{id}/', [LeagueController::class, 'edit'])->name('league.edit');
            Route::post('/update-league/{id}/', [LeagueController::class, 'update'])->name('league.update');
            Route::post('/update-player-league/{id}/', [LeagueController::class, 'updatePlayer'])->name('league.updatePlayer');
            Route::get('/delete-player-league/{id}/', [LeagueController::class, 'destroyPlayer'])->name('league.destroyPlayer');

            Route::get('/list-schedule-league/', [ScheduleController::class, 'league'])->name('schedule.league');
            Route::get('/list-schedule/', [ScheduleController::class, 'index'])->name('schedule.index');
            Route::get('/create-schedule', [ScheduleController::class, 'create'])->name('schedule.create');
            Route::get('/create-schedule-league/{id}', [ScheduleController::class, 'leagueSchedule'])->name('schedule.leagueSchedule');
            Route::post('/store-schedule/', [ScheduleController::class, 'store'])->name('schedule.store');
            Route::get('/schedule/{id}/', [ScheduleController::class, 'show'])->name('schedule.show');
            Route::get('/edit-schedule/{id}/', [ScheduleController::class, 'edit'])->name('schedule.edit');
            Route::post('/update-schedule/{id}/', [ScheduleController::class, 'update'])->name('schedule.update');
            Route::get('/result', [ScheduleController::class, 'result'])->name('schedule.result');

            Route::get('/list-group/', [GroupController::class, 'index'])->name('group.index');
            Route::post('/store-group/', [GroupController::class, 'store'])->name('group.store');
            Route::get('/create-group/', [GroupController::class, 'create'])->name('group.create');

            Route::get('/list-product/', [ProductController::class, 'index'])->name('product.index');
            Route::post('/store-product/', [ProductController::class, 'store'])->name('product.store');
            Route::get('/create-product/', [ProductController::class, 'create'])->name('product.create');
            Route::get('/edit-product/', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update-product/', [ProductController::class, 'update'])->name('product.update');
            Route::get('/delete-product/', [ProductController::class, 'delete'])->name('product.delete');
        }
    );
});
