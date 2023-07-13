<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliations extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "profile_tblAffiliations";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'organization',
        'position',
        'from_dt',
        'to_dt',
        'encoder',

    ];

    public function affiliationsPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
