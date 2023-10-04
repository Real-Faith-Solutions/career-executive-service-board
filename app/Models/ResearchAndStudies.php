<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchAndStudies extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'ctrlno';

    protected $table ="profile_tblResearch";

    protected $fillable = [

        'cesno',
        'title',
        'sponsor',
        'from_dt',
        'to_dt',
        'encoder',
        'lastupd_enc',

    ];

    public function researchAndStudiesPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
