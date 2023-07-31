<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalHistory extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table ="medical_history";

    protected $fillable = [

        'personal_data_cesno',
        'illness',
        'illness_date',
        'encoder',
    ];

    public function medicalHistoryPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
