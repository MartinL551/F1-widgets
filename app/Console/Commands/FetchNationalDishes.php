<?php

namespace App\Console\Commands;

use App\Models\NationalDish;
use App\Service\NationalDishService;
use Illuminate\Console\Command;

class FetchNationalDishes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-national-dishes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Current National Dish Data to DB';

    /**
     * Execute the console command.
     */
    public function handle(NationalDishService $nationalDishService)
    {
        $nationalDishes = $nationalDishService->getAllNationalDishes();

        $this->line('Fetch Latest Dishes From JSON', 'fg=blue');
        $this->error('Truncate Dishes Table');

        NationalDish::truncate();

        foreach ($nationalDishes as $countryDishes) {
            foreach ($countryDishes['dishes'] as $dish) {
                $this->warn('Inserting ' . $dish . ' ' .  $countryDishes['code']);
                 NationalDish::create([
                    'dish_name' => $dish,
                    'dish_country_name' => $countryDishes['name'],
                    'dish_country_code' => $countryDishes['code'],
                 ]);
            }
        }
    }
}
