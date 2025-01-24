<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class NationalDishService
{
    public function getAllNationalDishes()
    {
        return json_decode(Storage::disk('public')->get('national-dishes.json'), true);
    }
}
