<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', [CalendarController::class, 'showLatestRace']);

Route::get('/recipe-suggestions', [RecipeController::class, 'showRecipeSuggester']);

Route::get('/race-control', [RaceController::class, 'showRaceMessages']);


Route::get('/style-guide', function () {
    return view('styleguide');
});
