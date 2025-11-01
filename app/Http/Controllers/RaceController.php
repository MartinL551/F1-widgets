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

    public function getRaceMessages(Request $request)
    {
        $length = (int) $request->query('length');
        $raceMessages = $this->openF1->getRaceControllMessages($length ?? 0);
        $htmlMessages = [];


        foreach ($raceMessages as $key => $message) {
            $htmlMessages[] = view('Components.Message.message', ['message' => $message, 'index' => $key])->render();
        }

        return response()->json($htmlMessages);
    }
}
