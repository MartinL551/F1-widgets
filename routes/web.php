<?php

use App\Http\Controllers\calendarController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', [calendarController::class, 'showLatestRace']);

Route::get('/recipe-suggestions', [RecipeController::class, 'showRecipeSuggester']);


Route::get('/style-guide', function () {
    return view('styleguide');
});
