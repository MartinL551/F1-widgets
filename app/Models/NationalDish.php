<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NationalDish extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dish_name',
        'dish_country_code',
        'dish_country_name'
    ];

    public function races()
    {
        return $this->belongsToMany(F1Race::class, 'dish_race', 'dish_id', 'race_id');
    }
}
