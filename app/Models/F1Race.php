<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
