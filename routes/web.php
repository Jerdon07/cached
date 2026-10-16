<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('filament.app.pages.dashboard')
        : view('welcome');
})->name('home');

if (! app()->isProduction()) {
    Route::prefix('dev')->name('dev.')->group(function () {
        Route::get('login/sa', function () {

            auth()->loginUsingId(1);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/po', function () {
            auth()->loginUsingId(2);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/pm', function () {
            auth()->loginUsingId(3);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/wm', function () {
            auth()->loginUsingId(4);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/ws', function () {
            auth()->loginUsingId(5);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/sr', function () {
            auth()->loginUsingId(6);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/sm', function () {
            auth()->loginUsingId(7);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/ic', function () {
            auth()->loginUsingId(8);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/fo', function () {
            auth()->loginUsingId(9);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/gm', function () {
            auth()->loginUsingId(10);

            return redirect()->route('filament.app.pages.dashboard');
        });
    });
}
