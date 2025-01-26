<?php

namespace App\Http\Controllers;

use App\Models\F1Race;
use App\Service\OpenF1;
use App\Service\NationalDishService;

class RecipeController extends Controller
{
    public function __construct(
        protected OpenF1 $openF1,
        protected NationalDishService $nationalDishService,
    ) {
    }


    public function showRecipeSuggester()
    {


        return view('recipeSuggester', [
        ]);
    }
}
