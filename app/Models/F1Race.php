<?php

namespace App\Models;

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
        return $this->belongsToMany(F1Race::class, 'dish_race', 'dish_id', 'race_id');
    }

    public function getDishesForRace()
    {
        return $this->dishes()->get();
    }

    public static function getLatestRace()
    {
        return F1Race::where('race_date', '>', now()->subyear())->first()->get();
    }
}
