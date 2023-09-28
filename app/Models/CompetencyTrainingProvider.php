<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencyTrainingProvider extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'providerID';

    protected $table = 'training_tblProvider';
    
    protected $fillable = [

        'provider',
        'house_bldg',
        'st_road',
        'brgy_vill',
        'city_code',
        'contactno',
        'emailadd',
        'contactperson',
        'encoder',
        'updated_by',

    ];

    public function trainingProviderManager(): BelongsTo
    {
        return $this->belongsTo(ProfileLibCities::class, 'city_code');
    }
}
