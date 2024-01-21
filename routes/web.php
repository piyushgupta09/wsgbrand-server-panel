<?php

use Illuminate\Support\Facades\Route;
use Fpaipl\Panel\Http\Controllers\JobController;
use Fpaipl\Panel\Http\Controllers\PusherController;
use Fpaipl\Panel\Http\Controllers\DashboardController;
use Fpaipl\Panel\Http\Controllers\FailedjobController;
use Fpaipl\Panel\Http\Controllers\ActivitylogController;
use Fpaipl\Panel\Http\Controllers\NotificationsController;

Route::middleware(['web'])->group(function () {

    // Guest Pages
    Route::get('/', function () {
        return view('panel::pages.welcome');
    })->name('panel.welcome');

    Route::get('about-us', function () {
        return view('panel::pages.about-us');
    })->name('about-us');
    
    Route::get('terms-and-conditions', function () {
        return view('panel::pages.terms-and-conditions');
    })->name('terms-and-conditions');

    // Auth Routes
    Route::middleware(['auth','verified'])->group(function () {

        // Panel Dashboard
        Route::get('panel/dashboard', [DashboardController::class, 'index'])->name('panel.dashboard');
        
        Route::view('/pusher', 'panel::pusher.index')->name('pusher.index');
        Route::view('/pusher/show', 'panel::pusher.show')->name('pusher.show');
        Route::post('/pusher/push', [PusherController::class, 'push'])->name('pusher.push');

        Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications.index');
        Route::get('activitylogs', [ActivitylogController::class, 'index'])->name('activitylogs.index');
        Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('failedjobs', [FailedjobController::class, 'index'])->name('failedjobs.index');

        Route::get('notifications/{notification}', [NotificationsController::class, 'show'])->name('notifications.show');
        Route::get('activitylogs/{activitylog}', [ActivitylogController::class, 'show'])->name('activitylogs.show');
        Route::get('jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
        Route::get('failedjobs/{failedjob}', [FailedjobController::class, 'show'])->name('failedjobs.show');
        

    });

});
