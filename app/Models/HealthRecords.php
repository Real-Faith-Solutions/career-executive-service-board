<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthRecords extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table ="profile_tblHealthRecord";

    protected $fillable = [

        'personal_data_cesno',
        'blood_type',
        'marks',
        'handicap',
        'disability_handicap_defects_specify',
        'illness',
        'illness_date',
        'encoder',

    ];

    public function healthRecordPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }


}
