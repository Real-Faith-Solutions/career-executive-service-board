<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "request_file";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'request_pdflink',
        'request_pdflink_orignal_name',
        'request_unique_file_name',
        'remarks',
        'reason',
        'encoder',
        'decline_by'

    ];

    public function requestFilePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
