<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceSpeaker extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'speakerID';

    protected $table = "training_tblSpeakers";

    protected $fillable = [

        'cesno',
        'lastname',
        'firstname',
        'mi',
        'Position',
        'Department',
        'Office',
        'Bldg',
        'Street',
        'Brgy',
        'City',
        'zipcode',
        'contactno',
        'emailadd',
        'expertise',
        'encoder',
        'lastupd_enc',

    ];

    public function trainingEnagagement(): HasMany
    {
        return $this->hasMany(TrainingSession::class, 'speakerID', 'spearkerid');
    }
}
