<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseRecords extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = "profile_tblCaseRecord";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [
        
        'personal_data_cesno',
        'parties',
        'offence',
        'nature_code',
        'case_no',
        'filed_date',
        'venue',
        'status_code',
        'finality',
        'decision',
        'remarks',
        'encoder',

    ];

    public function caseRecordPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }


}
