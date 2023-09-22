<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InDepthValidation extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblIVP";

    protected $fillable = [

        'acno',
        'dteassign',
        'dtesubmit',
        'validator',
        'recom',
        'remarks',
        'dtedefer',
        'encoder',

    ];

    public function erisTblMainInDepthValidation(): BelongsTo
    {
        return $this->belongsTo(ErisTblMain::class, 'acno');
    }
}
