<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseRecords extends Model
{
    use HasFactory, SoftDeletes;
    
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = "profile_tblCaseRecord";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [
        
        'cesno',
        'parties',
        'offence',
        'nature_code',
        'case_no',
        'filed_dt',
        'venue',
        'status_code',
        'finality',
        'decision',
        'remarks',
        'encoder',
        'lastupd_enc',

    ];

    public function caseRecordPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }


}
