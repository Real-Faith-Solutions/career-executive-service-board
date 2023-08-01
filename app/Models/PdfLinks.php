<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PdfLinks extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table ="profile_tblmain_pdflink";

    protected $fillable = [

        'personal_data_cesno',
        'pdflink',
        'remarks',
        'encoder',

    ];

    public function pdfFilePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
