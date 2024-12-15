<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use View;

class calendarController extends Controller
{


    public function showLatestRace()
    {
        $data = Http::get('https://api.openf1.org/v1/meetings?year=2023&country_name=Singapore');

        dump($data->getBody()->getContents());

        return view('latest-race', [
            'jsonString' => 'test',
        ]);
    }
}
