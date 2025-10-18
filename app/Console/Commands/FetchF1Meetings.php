<?php

namespace App\Console\Commands;

use App\Models\F1Race;
use App\Models\NationalDish;
use App\Service\NationalDishService;
use App\Service\OpenF1;
use Illuminate\Console\Command;
use Carbon;

class FetchF1Meetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-f1-meetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all current F1 meetins and add to database';

    /**
     * Execute the console command.
     */
    public function handle(OpenF1 $openF1, NationalDishService $nationalDishService)
    {
        $year = now()->format('Y');
        $currentRaces = $openF1->getRacesForAYear($year);

        if (count($currentRaces) === 0) {
            $year = now()->subYear()->format('Y');
            $currentRaces = $openF1->getRacesForAYear($year);
        }



        $this->error('Truncate Race Table');
        $existingRaces = F1Race::whereNotNull('id')->get();

        foreach ($existingRaces as $race) {
            $race->dishes()->delete();
        }

        $avalDishes = $nationalDishService->getAllNationalDishes();
        $dishesMapped = [];

        foreach ($avalDishes as $countryDishes) {
            $dishesMapped[$countryDishes['code']][] = $countryDishes;
        }


        $this->line('Fetch Latest Races From API', 'fg=blue');
        $this->warn('Creating New Races from API, year: ' . $year);
        foreach ($currentRaces as $race) {
            $this->warn('Inserting ' . $race['meeting_name']);
            $currentRace = F1Race::create(
                [
                    'race_name' => $race['meeting_name'],
                    'race_circuit_name' => $race['circuit_short_name'],
                    'race_circuit_key' => $race['circuit_key'],
                    'race_date' => $race['date_start'],
                    'race_country_code' => $race['country_code'],
                    'race_country_name' => $race['country_name'],
                    'race_api_key' => $race['meeting_key'],
                ]
            );

            if (isset($dishesMapped[$race['country_code']])) {
                foreach ($dishesMapped[$race['country_code']] as $key => $dish) {
                      $this->warn('Inserting ' . $dish['name'] . ' ' .  $race['country_code']);
                    foreach ($dish['dishes'] as $dishItem) {
                        $dishInstance = new NationalDish();
                        $dishInstance->dish_name = $dishItem;
                        $dishInstance->dish_country_name = $dish['name'];
                        $dishInstance->dish_country_code = $dish['code'];
                        $currentRace->dishes()->save($dishInstance);
                    }
                }
            }

            $this->info('Creating Relationships ' . $race['meeting_name']);
        }
    }
}
