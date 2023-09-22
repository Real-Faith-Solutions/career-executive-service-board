<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapidValidation extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblRVP";

    protected $fillable = [

        'dteassign', // date assign
        'dtesubmit', // date submnit
        'validator',
        'recom', // recommendation
        'remarks',
        'encoder',

    ];

    public function erisTblMainRapidValidation(): BelongsTo
    {
        return $this->belongsTo(ErisTblMain::class, 'acno');
    }
}
