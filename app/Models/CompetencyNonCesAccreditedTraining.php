<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencyNonCesAccreditedTraining extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table = "training_tblOtherAccre";

    protected $fillable = [

        'personal_data_cesno',
        'training',
        'training_category',
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

    public function nonCesTrainingProvider(): BelongsTo
    {
        return $this->belongsTo(CompetencyTrainingProvider::class, 'providerID');
    }
}
