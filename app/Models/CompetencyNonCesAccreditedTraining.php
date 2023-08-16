<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetencyNonCesAccreditedTraining extends Model
{
    use HasFactory;

    protected $primaryKey = 'ctrlno';

    protected $table = "training_tblOtherAccre";

    protected $fillable = [

        'personal_data_cesno',
        'training',
        'no_hours',
        'sponsor',
        'venue',
        'from_dt',
        'to_dt',
        'specialization',
        'encoder',
        'updated_by',
        'providerID',

    ];

    public function trainingProvider(): BelongsTo
    {
        return $this->belongsTo(CompetencyTrainingProvider::class, 'providerID');
    }
}
