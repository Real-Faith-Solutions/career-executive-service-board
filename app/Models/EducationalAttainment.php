<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalAttainment extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'profile_tblEducation';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'level',
        'degree_code',
        'major_code',
        'school_code',
        'school_status',
        'period_of_attendance_from',
        'year_grad',
        'degree_status',
        'honors',
        'encoder',
        'lastupd_enc',

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
