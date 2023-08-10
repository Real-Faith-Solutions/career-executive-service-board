<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchAndStudies extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $primaryKey = 'ctrlno';

    protected $table ="profile_tblResearch";

    protected $fillable = [

        'personal_data_cesno',
        'title',
        'publisher',
        'inclusive_date_from',
        'inclusive_date_to',
        'encoder',

    ];

    public function researchAndStudiesPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
