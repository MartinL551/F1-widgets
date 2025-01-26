<?php

namespace App\Service;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class NationalDishService
{
    public function getAllNationalDishes()
    {
        return Storage::disk('public')->json('national-dishes.json');
    }
}
