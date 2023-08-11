<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblWorkExperience extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $table = "profile_tblWorkExperience";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
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

    ];
    
    public function workExperiencePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
    
}
