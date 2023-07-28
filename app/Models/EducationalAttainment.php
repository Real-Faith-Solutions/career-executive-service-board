<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalAttainment extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table = 'profile_tblEducation';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'level',
        'degree_code',
        'major_code',
        'school_code',
        'school_type',
        'period_of_attendance_from',
        'period_of_attendance_to',
        'highest_level',
        'year_graduate',
        'academics_honor_received',
        'encoder',

    ];

    public function profileLibTblEducDegree(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblEducDegree::class, 'degree_code');
    }

    public function profileLibTblEducMajor(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblEducMajor::class, 'major_code');
    }

    public function profileLibTblEducSchool(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblEducSchool::class, 'school_code');
    }

}