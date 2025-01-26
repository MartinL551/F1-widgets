<?php

namespace App\Models;

use App\Service\OpenF1;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class F1Race extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'race_name',
        'race_circuit_name',
        'race_circuit_key',
        'race_date',
        'race_country_code',
        'race_country_name',
        'race_api_key',
    ];


    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(NationalDish::class, 'dish_race', 'dish_id', 'race_id');
    }

    public function getDishesForRace()
    {
        return $this->dishes()->get();
    }

    public static function getLatestRace()
    {
        // To Do get this based on actual date
        return F1Race::first();
    }
}
