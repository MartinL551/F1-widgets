<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Url;

class OpenF1
{
    public function __construct(
        protected $api_base_url,
    ) {
        $this->api_base_url = url($api_base_url);
    }



    public function getCurrentRace()
    {
        $url = $this->api_base_url->query('/meetings', ['meetings_key' => 'latest']);
        $data = Http::get($url);

        return $data->getBody()->getContents();
    }

    public function getRacesForAYear(string $year)
    {
        $url = $this->api_base_url->query('/meetings', ['year' => $year]);
        $data = Http::get($url);

        return $data->getBody()->getContents();
    }
}
