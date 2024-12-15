<?php

use App\Http\Controllers\calendarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', [calendarController::class, 'showLatestRace']);
