<?php

namespace App\Console\Commands;

use App\Models\F1Race;
use App\Service\OpenF1;
use Illuminate\Console\Command;

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
        $year = date('Y');
        $currentRaces = $openF1->getRacesForAYear($year);

        F1Race::truncate();

        foreach ($currentRaces as $race) {
            F1Race::create(
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
        }
    }
}
