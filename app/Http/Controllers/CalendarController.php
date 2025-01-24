<?php

namespace App\Http\Controllers;

use App\Service\NationalDishService;
use App\Service\OpenF1;
use Illuminate\Support\Facades\Http;

class CalendarController extends Controller
{
    public function __construct(
        protected OpenF1 $openF1,
        protected NationalDishService $nationalDishService,
    ) {
    }

    public function showLatestRace()
    {
        $latestRace = $this->openF1->getRacesForAYear(2024);
        $allDishes = $this->nationalDishService->getAllNationalDishes();

        return view('latestRace', [
            'calendarString' => $latestRace,
            'dishesString' => $allDishes,
        ]);
    }
}
