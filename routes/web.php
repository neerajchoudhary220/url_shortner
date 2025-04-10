<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');redirect()->route('dashboard');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
});

Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard')->group(function () {
        Route::get('/','index');
        Route::get('/company-list','company_list')->name('.company.list');
        Route::get('/team-member-list','teamMemberList')->name('.team.member.list');
    });

    Route::controller(InvitationController::class)->prefix('invite')->name('invite')->group(function () {
        Route::get('/{company_id?}', 'index');
        Route::post('store', 'store')->name('.store');
    });

    Route::controller(ShortUrlController::class)->prefix('shortUrl')->name('shortUrl')->group(function(){
        Route::get('show-list/{company}','index')->name('.show.list');
        Route::get('/generate-short-url','showGenerateUrlForm')->name('.generate');
        Route::post('/generate-short-url','generateShortUrl');
        Route::get('/list/{company_id?}','shortUrlList')->name('.list');
        Route::get('/s/{code}','redirect')->name('.redirect');

    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
