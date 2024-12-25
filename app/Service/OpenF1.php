<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Uri;

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

        return $data->getBody()->getContents();
    }

    public function getRacesForAYear(string $year)
    {
        $url = (string) $this->api_base_url->withPath('v1/meetings',)->withQuery(['year' => $year]);
        $data = Http::get($url);


        return $data->json();
    }
}
