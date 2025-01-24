<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class NationalDishService
{
    public function getAllNationalDishes()
    {
        return Storage::disk('public')->get('national-dishes.json');
    }
}
