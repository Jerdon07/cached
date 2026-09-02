<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('filament.app.pages.dashboard')
        : view('welcome');
})->name('home');

if (! app()->isProduction()) {
    Route::prefix('dev')->name('dev.')->group(function () {
        Route::get('login/systemadministration', function () {
            auth()->loginUsingId(1);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/purchasingofficer', function () {
            auth()->loginUsingId(2);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/purchasingmanager', function () {
            auth()->loginUsingId(3);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/warehousemanager', function () {
            auth()->loginUsingId(4);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/warehousestaff', function () {
            auth()->loginUsingId(5);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/salesrepresentative', function () {
            auth()->loginUsingId(6);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/salesmanager', function () {
            auth()->loginUsingId(7);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/inventorycontroller', function () {
            auth()->loginUsingId(8);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/financeofficer', function () {
            auth()->loginUsingId(9);

            return redirect()->route('filament.app.pages.dashboard');
        });

        Route::get('login/generalmanager', function () {
            auth()->loginUsingId(10);

            return redirect()->route('filament.app.pages.dashboard');
        });
    });
}
