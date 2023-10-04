<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblWorkExperience extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = "profile_tblWorkExperience";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'from_dt',
        'to_dt',
        'designation',
        'status',
        'annually_salary',
        'salary',
        'department',
        'government_service',
        'remarks',
        'encoder',
        'lastupd_enc',

    ];
    
    public function workExperiencePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
    
}
