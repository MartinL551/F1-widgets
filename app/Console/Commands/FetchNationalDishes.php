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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(NationalDishService $nationalDishService)
    {
        $year = date('Y');
        $dishes = $nationalDishService->getAllNationalDishes();

        NationalDish::truncate();

        foreach ($dishes as $dish) {
            NationalDish::create(
                [
                    ''

                ]
            );
        }
    }
}
