<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\OpenF1;

class RaceController extends Controller
{
    public function __construct(
        protected OpenF1 $openF1,
    ) {
    }

    public function showRaceMessages()
    {
        $raceMessages = $this->openF1->getRaceControllMessages();

        return view('raceMessages', [
            'messages' => $raceMessages,
        ]);
    }
}
