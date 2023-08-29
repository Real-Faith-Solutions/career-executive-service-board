<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovedFile extends Model
{
    use HasFactory;

    protected $primaryKey = 'ctrlno';

    protected $table = "approved_file";

    protected $fillable = 
    [

        'personal_data_cesno',
        'pdflink',
        'original_pdflink',
        'request_date',
        'requested_by',
        'remarks',
        'encoder',

    ];

    public function approvedFilePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
}
