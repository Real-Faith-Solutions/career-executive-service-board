<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthRecords extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'ctrlno';

    protected $table ="profile_tblHealthRecord";

    protected $fillable = [

        'cesno',
        'blood_type',
        'marks', // 'identifying_marks',
        'handicap', // 'person_with_disability',  
        'encoder',
        'lastupd_enc',

    ];

    public function healthRecordPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
}
