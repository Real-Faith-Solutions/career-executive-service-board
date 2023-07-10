<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalAttainment extends Model
{
    use HasFactory;
    
    protected $table = 'profile_tblEducation';

    protected $primaryKey = 'ctrlno';

    use SoftDeletes;

    protected $fillable = [

        'personal_data_cesno',
        'level',
        'specialization',
        'school',
        'degree',
        'school_type',
        'period_of_attendance_from',
        'period_of_attendance_to',
        'highest_level',
        'year_graduate',
        'academics_honor_received',
        'encoder',

    ];

    public function educationalAttainmentPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}