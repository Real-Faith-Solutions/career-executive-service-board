<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scholarships extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $table ="profile_tblScholarship";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'type',
        'title',
        'sponsor',
        'inclusive_date_from',
        'inclusive_date_to',
        'encoder',

    ];

    public function scholarshipsPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
    
}
