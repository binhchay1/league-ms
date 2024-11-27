<?php

use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LeagueController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
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

    Route::get('/', [HomeController::class, 'viewHome'])->name('home');
    Route::get('/tournament-leagues/', [HomeController::class, 'listLeague'])->name('list.league');
    Route::post('/search/', [HomeController::class, 'viewSearch'])->name('search.result');
    Route::get('/search/', [HomeController::class, 'viewSearch'])->name('search');
    Route::get('/gioi-thieu/', [HomeController::class, 'viewAbout'])->name('about');
    Route::get('/doi-hinh/', [HomeController::class, 'team'])->name('team');
    Route::get('/term-and-conditions/', [HomeController::class, 'viewTermAndConditions'])->name('term.and.conditions');
    Route::get('/tournament-league/{slug}/', [HomeController::class, 'showInfo'])->name('league.info');
    Route::get('/tournament-league/{slug}/player/', [HomeController::class, 'showPlayer'])->name('leaguePlayer.info');
    Route::get('/tournament-league/{slug}/result/', [HomeController::class, 'showResult'])->name('leagueResult.info');
    Route::get('/tournament-league/{slug}/schedule/', [HomeController::class, 'showSchedule'])->name('leagueSchedule.info');
    Route::get('/tournament-league/{slug}/bracket/', [HomeController::class, 'showBracket'])->name('leagueResult.bracket');
    Route::get('/news/{slug}', [HomeController::class, 'newsDetail'])->name('news-show');
    Route::get('/news', [HomeController::class, 'news'])->name('news');
    Route::get('/news/category/{slug}', [HomeController::class, 'newsCategory'])->name('newsCategory');

Route::get('/login/', [AuthController::class, 'login'])->name('login');
Route::post('/custom-login/', [AuthController::class, 'customLogin'])->name('login.custom');
Route::post('/custom-login-mobile/', [AuthController::class, 'customLogin'])->name('login.custom-mobile');
Route::get('/auth/google/', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback/', [SocialLoginController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook/', [SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback/', [SocialLoginController::class, 'handleFacebookCallback']);
Route::get('/auth/line/', [SocialLoginController::class, 'redirectToLine'])->name('auth.line');
Route::get('/auth/line/callback/', [SocialLoginController::class, 'handleLineCallback']);
Route::get('/auth/apple/', [SocialLoginController::class, 'redirectToApple'])->name('auth.apple');
Route::post('/auth/apple/callback/', [SocialLoginController::class, 'handleAppleCallback']);
Route::get('/register/', [AuthController::class, 'registerUser'])->name('register_user');
Route::post('/register/', [AuthController::class, 'storeUser'])->name('storeUser');
Route::get('/setLocale/{locale}/', [HomeController::class, 'changeLocate'])->name('app.setLocale');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile/{nick_name}/', [ProfileController::class, 'show'])->name('profile.info');
    Route::get('/user-profile/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/user-profile/{id}/', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password/', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password/', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('/my-league/', [ProfileController::class, 'viewMyLeague'])->name('my.league');

    Route::get('/league-manager/', [HomeController::class, 'leagueManager'])->name('league-manager');
    Route::post('/register-league/', [HomeController::class, 'saveRegisterLeague'])->name('registerLeague');
    Route::get('/player/{id}/', [HomeController::class, 'viewInforPlayer'])->name('player.info');
    Route::get('/read-notifications/', [HomeController::class, 'readNotification'])->name('read.notification');
    Route::get('/profile/', [AuthController::class, 'profile'])->name('profile');
    Route::post('/messages/', [AuthController::class, 'sendMessage'])->name('send.message');
    Route::get('/logout/', [AuthController::class, 'logout'])->name('logout');
    Route::get('/live-score/', [HomeController::class, 'liveScore'])->name('live.score');


    //league
    Route::get('/list-league/', [LeagueController::class, 'index'])->name('league.index');
    Route::get('/create-league/', [LeagueController::class, 'create'])->name('league.create');
    Route::get('/get-league/{id}', [LeagueController::class, 'leagueById'])->name('league.leagueById');
    Route::post('/store-league/', [LeagueController::class, 'store'])->name('league.store');
    Route::get('/league/{slug}/', [LeagueController::class, 'show'])->name('league.show');
    Route::get('/edit-league/{slug}/', [LeagueController::class, 'edit'])->name('league.edit');
    Route::get('/delete/{slug}/', [LeagueController::class, 'destroy'])->name('league.delete');
    Route::post('/update-league/{id}/', [LeagueController::class, 'update'])->name('league.update');
    Route::post('/update-player-league', [LeagueController::class, 'updatePlayer'])->name('league.updatePlayer');
    Route::get('/delete-player-league/{id}/', [LeagueController::class, 'destroyPlayer'])->name('league.destroyPlayer');
    Route::get('/active-league/{id}', [LeagueController::class, 'activeLeague'])->name('activeLeague');


    //schedule
    Route::get('/list-schedule-league/', [ScheduleController::class, 'league'])->name('schedule.league');
    Route::get('/list-schedule/', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/create-schedule', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::get('/create-schedule-league/{slug}', [ScheduleController::class, 'leagueSchedule'])->name('schedule.leagueSchedule');
    Route::post('/store-schedule/', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{id}/', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::get('/edit-schedule/{id}/', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::post('/update-schedule/{id}/', [ScheduleController::class, 'updateSchedule'])->name('schedule.update');
    Route::post('/update-result/{id}/', [ScheduleController::class, 'updateResult'])->name('schedule.updateResult');
    Route::get('/result', [ScheduleController::class, 'result'])->name('schedule.result');
    Route::get('/auto-create-league', [ScheduleController::class, 'autoCreateLeague'])->name('auto.create.schedule');
    Route::get('/store-score', [ScheduleController::class, 'storeScore'])->name('store.score');




    //category post
    Route::get('/list-category-post/', [CategoryPostController::class, 'index'])->name('categoryPost.index');
    Route::get('/create-category-post/', [CategoryPostController::class, 'create'])->name('categoryPost.create');
    Route::post('/store-category-post/', [CategoryPostController::class, 'store'])->name('categoryPost.store');
    Route::get('/category-post/{id}/', [CategoryPostController::class, 'show'])->name('categoryPost.show');
    Route::get('/edit-category-post/{id}/', [CategoryPostController::class, 'edit'])->name('categoryPost.edit');
    Route::post('/update-category-post/{id}/', [CategoryPostController::class, 'update'])->name('categoryPost.update');
    Route::get('/destroy-category-post/{id}/', [CategoryPostController::class, 'destroy'])->name('categoryPost.destroy');

    //post
    Route::get('/list-posts/', [PostController::class, 'index'])->name('post.index');
    Route::get('/create-post/', [PostController::class, 'create'])->name('post.create');
    Route::post('/store-post/', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/', [PostController::class, 'show'])->name('post.show');
    Route::get('/edit-post/{id}/', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/update-post/{id}/', [PostController::class, 'update'])->name('post.update');
    Route::get('/destroy/{id}/', [PostController::class, 'destroy'])->name('post.destroy');


    Route::middleware(['admin'])->group(
        function () {
            Route::get('/dashboard/', [DashboardController::class, 'dashboard'])->name('dashboard');;
            Route::get('/set-title/{id}/', [UserController::class, 'setTitle'])->name('set.title');
            Route::post('/save-title/{id}/', [UserController::class, 'saveTitle'])->name('save.title');

            Route::get('/list-user/', [UserController::class, 'index'])->name('user.index');
            Route::get('/delete/{id}/', [UserController::class, 'destroy'])->name('user.delete');

            Route::get('/list-product/', [ProductController::class, 'index'])->name('product.index');
            Route::post('/store-product/', [ProductController::class, 'store'])->name('product.store');
            Route::get('/create-product/', [ProductController::class, 'create'])->name('product.create');
            Route::get('/edit-product/', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update-product/', [ProductController::class, 'update'])->name('product.update');
            Route::get('/delete-product/', [ProductController::class, 'delete'])->name('product.delete');
        }
    );
});
