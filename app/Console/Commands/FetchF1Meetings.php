<?php

namespace App\Console\Commands;

use App\Models\F1Race;
use App\Models\NationalDish;
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
    public function handle(OpenF1 $openF1)
    {
        $year = now()->format('Y');
        $currentRaces = $openF1->getRacesForAYear($year);

        if (count($currentRaces) === 0) {
            $year = now()->subYear()->format('Y');
            $currentRaces = $openF1->getRacesForAYear($year);
        }



        $this->error('Truncate Race Table');
        $existingRace = F1Race::whereNotNull('id');

        foreach ($existingRace as $race) {
            $existingRace->dishes()->delete();
        }

        $this->call('app:fetch-national-dishes');

        $this->line('Fetch Latest Races From API', 'fg=blue');
        $this->warn('Creating New Races from API, year: ' . $year);
        foreach ($currentRaces as $race) {
            $this->warn('Inserting ' . $race['meeting_name']);
            $currenctRace = F1Race::create(
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

            $dishes = NationalDish::where('dish_country_code', '=', $race['country_code'])->get();

            $this->info('Creating Relationships ' . $race['meeting_name']);

            $currenctRace->dishes()->saveMany($dishes);

            $this->info('Created: ' . $dishes->count());
        }
    }
}
