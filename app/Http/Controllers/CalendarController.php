<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use View;

class calendarController extends Controller
{
    public function showLatestRace()
    {

        return view('latest-race', [
            'jsonString' => 'test',
        ]);
    }
}
