<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblTrainingMngt extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = "profile_tblTrainingMngt";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'training',
        'training_category', 
        'sponsor',
        'venue',
        'no_training_hours',
        'from_dt',
        'to_dt',
        'field_specialization',
        'encoder',
        'lastupd_enc',

    ];

    public function trainingProfileLibTblExpertiseSpec(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblExpertiseSpec::class, 'field_specialization');
    }
}
