<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Url;

;

class OpenF1
{
    private Url $api_base_url;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $config = config('openf1.api_base_url') ?: '';
        $this->api_base_url = url($config);
    }

    public function getCurrentRace()
    {
        $url = $this->api_base_url->query('/meetings', ['meetings_key' => 'latest']);
        $data = Http::get($url);

        return $data->getBody()->getContents();
    }
}
