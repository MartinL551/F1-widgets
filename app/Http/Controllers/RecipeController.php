<?php

namespace App\Http\Controllers;

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
        $nextRace = $this->openF1->getCurrentRace();

        return view('recipeSuggester', [
        ]);
    }
}
