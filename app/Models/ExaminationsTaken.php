<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExaminationsTaken extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'profile_tblExaminations';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'exam_code',
        'rating',
        'date_of_examination',
        'place_of_examination',
        'license_number',
        'date_acquired',
        'date_validity',
        'encoder',

    ];

    public function profileLibTblExamRefPersonalData(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblExamRef::class, 'exam_code');
    }

}