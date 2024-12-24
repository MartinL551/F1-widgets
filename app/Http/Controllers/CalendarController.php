<?php

namespace App\Http\Controllers;

use App\Service\OpenF1;
use Illuminate\Support\Facades\Http;
use View;

class CalendarController extends Controller
{
    public function __construct(
        protected OpenF1 $openF1,
    ) {
    }

    public function showLatestRace()
    {
        $latestRace = $this->openF1->getCurrentRace();

        return view('latest-race', [
            'jsonString' => $latestRace,
        ]);
    }
}
