<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblExpertise extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table = "profile_tblExpertise";

    protected $fillable = [

        'personal_data_cesno',
        'expertise_specialization',
        'encoder',
    
    ];

    public function expertisePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
