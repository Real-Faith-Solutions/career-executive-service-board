<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclineFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table = "decline_file";

    protected $fillable = [

        'personal_data_cesno',
        'pdf_path_name',
        'pdf_unique_name',
        'remarks',
        'encoder',

    ];

    public function declineFilePersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
}
