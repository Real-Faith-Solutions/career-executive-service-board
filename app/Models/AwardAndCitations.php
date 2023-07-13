<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardAndCitations extends Model
{

    use HasFactory;
    
    use SoftDeletes;
    
    protected $table = "profile_tblAwards";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'awards',
        'sponsor',
        'date',
        'encoder',

    ];

    public function awardAndCitationPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
