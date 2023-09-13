<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sessionid';

    protected $table = "training_tblSessions";

    protected $fillable = [

        'title',
        'category',
        'specialization',
        'from_dt',
        'to_dt',
        'venueId',
        'status',
        'remarks',
        'barrio',
        'no_hours',
        'session_director',
        'training_asst',
        'speakerid',
        'encoder',
        'updated_by',
        
    ];

    // public function trainingParticipantList(): HasManyThrough
    // {
    //     return $this->hasManyThrough(
    //         TrainingParticipants::class, 
    //         PersonalData::class,
    //         'sessionid',
    //         'cesno',
    //         'pid',
    //         'sessionid',
    //     );
    // }

    public function trainingParticipantList(): HasMany
    {
        return $this->hasMany(TrainingParticipants::class, 'sessionid', 'sessionid');
    }

    public function venuePersonalData(): BelongsTo
    {
        return $this->belongsTo(CompetencyTrainingVenueManager::class, 'venueId');
    }

    public function resourceSpeakerPersonalData(): BelongsTo
    {
        return $this->belongsTo(ResourceSpeaker::class, 'speakerid');
    }
}
