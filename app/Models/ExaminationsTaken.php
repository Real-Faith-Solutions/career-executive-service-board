<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExaminationsTaken extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'profile_tblExaminations';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'exam_code',
        'rate',
        'exam_date',
        'exam_place',
        'license_number',
        'date_acquired',
        'date_validity',
        'encoder',
        'lastupd_enc',

    ];

    public function examPlace(): BelongsTo
    {
        return $this->belongsTo(ProfileLibCities::class, 'exam_place', 'city_code');
    }

    public function profileLibTblExamRefPersonalData(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblExamRef::class, 'exam_code');
    }
}