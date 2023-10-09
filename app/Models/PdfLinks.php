<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PdfLinks extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';

    protected $primaryKey = 'ctrlno';

    protected $table ="profile_tblmain_pdflink";

    protected $fillable = [

        'cesno',
        'pdflink',
        'original_pdflink',
        'request_date',
        'requested_by',
        'remarks',
        'encoder',

    ];

    public function pdfFilePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
