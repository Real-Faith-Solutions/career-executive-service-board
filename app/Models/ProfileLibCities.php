<?php

namespace App\Models;

use App\Models\Plantilla\OfficeAddress;
use App\Models\Plantilla\OtherAssignment;
use App\Models\Plantilla\PlanPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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

    public function cities(): HasManyThrough
    {
        return $this->hasManyThrough(OtherAssignment::class, 'city_code', OfficeAddress::class, 'city_code', PersonalData::class, 'city_code');
    }

    public function competencyTrainingProviderManager(): HasMany
    {
        return $this->hasMany(CompetencyTrainingProvider::class, 'city_code', 'city_code');
    }

    public function competencytrainingVenueManager(): HasMany
    {
        return $this->hasMany(CompetencyTrainingVenueManager::class, 'city_code', 'city_code');
    }
}
