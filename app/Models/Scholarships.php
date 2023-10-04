<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scholarships extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table ="profile_tblScholarship";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'type',
        'title',
        'sponsor',
        'from_dt',
        'to_dt',
        'encoder',
        'lastupd_enc',

    ];

    public function scholarshipsPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }    
}
