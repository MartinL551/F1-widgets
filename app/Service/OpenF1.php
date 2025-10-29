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
        $sessionKey = $this->getLatestSessionType();



        if (($cached = Cache::get('race_control')) && $cached['meeting_key'] === $currentRace->race_api_key) {
            if ($this->checkCacheExpired($cached['timestamp'] ?? null)) {
                Cache::forget('race_control');
            } else {
                return $cached['messages'];
            }
        }

        $url = (string) $this->api_base_url->withPath('v1/race_control')->withQuery(['meeting_key' => $currentRace->race_api_key, 'session_key' => $sessionKey]);
        $data = Http::get($url);

        Cache::set('race_control', ['messages' => $data->json(), 'meeting_key' => $currentRace->race_api_key, 'timestamp' => now()]);

        return $data->json();
    }

    public function getLatestSessionType()
    {
        $currentRace = F1Race::getLatestRace();

        if (($cached = Cache::get('session')) && $cached['meeting_key'] === $currentRace->race_api_key) {
            if ($this->checkCacheExpired($cached['timestamp'] ?? null)) {
                Cache::forget('session');
            } else {
                return $cached['session_key'];
            }
        }

        $url = (string) $this->api_base_url->withPath('v1/sessions')->withQuery(['meeting_key' => $currentRace->race_api_key, 'session_key' => 'latest']);
        $data = Http::get($url);
        $data = $data->json();

        Cache::set('session', ['session_key' => $data[0]['session_key'],'meeting_key' => $currentRace->race_api_key, 'timestamp' => now()]);

        return $data[0]['session_key'];
    }

    public function expireCurrentCache()
    {
        Cache::forget('session');
        Cache::forget('race_control');
    }

    public function checkCacheExpired($cacheTimestamp)
    {
        $now = now();
        $cacheTime = \Carbon\Carbon::parse($cacheTimestamp);
        $diffInHours = $now->diffInHours($cacheTime);

        return $diffInHours >= 12;
    }
}
