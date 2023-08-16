<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibCities extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'city_code';

    protected $table = "profilelib_tblcities";

    protected $fillable = [

        'prov_code',
        'name',
        'zipcode',

    ];

    public function trainingProviderManager(): HasMany
    {
        return $this->hasMany(CompetencyTrainingProvider::class, 'city_code', 'city_code');
    }
}
