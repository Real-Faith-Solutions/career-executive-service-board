<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardAndCitations extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';
    
    protected $table = "profile_tblAwards";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'awards',
        'sponsor',
        'award_dt',
        'encoder',
        'lastupd_enc',

    ];

    public function awardAndCitationPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
}
