<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencyTrainingVenueManager extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encoder_dt';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'venueid';

    protected $table = "traininglib_tblvenue";

    protected $fillable = [

        'name',
        'no_street',
        'brgy',
        'city_code',
        'contactno',
        'emailadd',
        'contactperson',
        'encoder',
        'lastupd_enc',

    ];

    public function trainingVenueManager(): BelongsTo
    {
        return $this->belongsTo(ProfileLibCities::class, 'city_code');
    }
}
