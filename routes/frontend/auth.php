<?php

// Socialite Routes
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;


Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
    // These routes require the user to be logged in
    Route::group(['middleware' => 'auth'], function () {
        //For when admin is logged in as user from backend
        Route::get('logout-as', [LoginController::class, 'logoutAs'])->name('logout-as');
    });

    // These routes require no user to be logged in
    Route::group(['middleware' => 'guest'], function () {
        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'login']);
    });
});

Auth::routes();
