<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingParticipants extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'pid'; //participants id

    protected $table = "training_tblparticipants";

    protected $fillable = [

        'cesno',
        'sessionid',
        'status',
        'remarks',
        'no_hours',
        'payment',
        'encoder',
        'updated_by',

    ];

    public function cesTrainingPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

    public function participantTrainingSession(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class, 'sessionid');
    }
}
