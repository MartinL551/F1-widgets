<?php

namespace App\Service;

use App\Models\F1Race;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Uri;
use Illuminate\Support\Facades\Cache;

class OpenF1
{
    public function __construct(
        protected $api_base_url,
    ) {
        $this->api_base_url = Uri::of($api_base_url);
    }


    public function getCurrentRace()
    {
        $url = (string) $this->api_base_url->withPath('v1/meetings')->withQuery(['meeting_key' => 'latest']);
        $data = Http::get($url);

        return $data->json();
    }

    public function getRacesForAYear(string $year)
    {
        $url = (string) $this->api_base_url->withPath('v1/meetings',)->withQuery(['year' => $year]);
        $data = Http::get($url);

        return $data->json();
    }

    public function getRaceControllMessages()
    {
        $currentRace = F1Race::getLatestRace();
        $session = $this->getLatestSession();
        $sessionStart = \Carbon\Carbon::parse($session['start']);
        $sessionEnd = \Carbon\Carbon::parse($session['end']);

        if (($cached = Cache::get('race_control')) && $cached['meeting_key'] === $currentRace->race_api_key) {
            if ($this->checkSessionActive($sessionStart, $sessionEnd)) {
                Cache::forget('race_control');
            } else {
                return $cached['messages'];
            }
        }

        $url = (string) $this->api_base_url->withPath('v1/race_control')->withQuery(['meeting_key' => $currentRace->race_api_key, 'session_key' => $session['session_key']]);
        $data = Http::get($url);

        Cache::set('race_control', ['messages' => array_reverse($data->json()), 'meeting_key' => $currentRace->race_api_key, 'timestamp' => now()]);

        return array_reverse($data->json());
    }

    public function getLatestSession()
    {
        $currentRace = F1Race::getLatestRace();

        if (($cached = Cache::get('session')) && $cached['meeting_key'] === $currentRace->race_api_key) {
            return $cached;
        }

        $url = (string) $this->api_base_url->withPath('v1/sessions')->withQuery(['meeting_key' => $currentRace->race_api_key, 'session_key' => 'latest']);
        $data = Http::get($url);
        $data = $data->json();

        Cache::set('session', ['session_key' => $data[0]['session_key'],'meeting_key' => $currentRace->race_api_key, 'start' => $data[0]['date_start'], 'end' => $data[0]['date_end']], now()->addHours(5));

        return Cache::get('session');
    }

    public function checkSessionActive($sessionStart, $sessionEnd)
    {
        $now = now();

        return $now->between($sessionStart, $sessionEnd);
    }
}
