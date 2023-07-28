<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblTrainingMngt extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "profile_tblTrainingMngt";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'training',
        'training_category', 
        'sponsor',
        'venue',
        'no_training_hours',
        'from_date',
        'to_date',
        'field_specialization',
        'encoder',

    ];

    public function trainingProfileLibTblExpertiseSpec(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblExpertiseSpec::class, 'field_specialization');
    }
}
