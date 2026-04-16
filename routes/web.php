<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { return view('dashboard'); });
Route::get('/about', function(){ return view('about'); });


Route::get('/test',  [DashboardController::class, 'index'])->name('testView');
Route::get('/fetch-random-words', [APIController::class, 'fetchRandomWords'])->name('fetchRandomWords');

Route::post('/update-bgwallpaper', [DashboardController::class, 'updateWallpaper'])->name('updateWallpaper');