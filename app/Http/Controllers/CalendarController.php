<?php

namespace App\Http\Controllers;

use App\Service\NationalDishService;
use App\Service\OpenF1;
use Illuminate\Support\Facades\Http;

class CalendarController extends Controller
{
    public function __construct(
        protected OpenF1 $openF1,
    ) {
    }

    public function showLatestRace()
    {
        $allRaces = $this->openF1->getRacesForAYear(now()->format('Y'));

        return view('calendar', [
            'races' => $allRaces,
        ]);
    }
}
