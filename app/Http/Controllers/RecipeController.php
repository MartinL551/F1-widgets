<?php

namespace App\Http\Controllers;

use App\Service\OpenF1;

class RecipeController extends Controller
{
    public function __construct(
        protected OpenF1 $openF1,
    ) {
    }


    public function showRecipeSuggester()
    {
    }
}
