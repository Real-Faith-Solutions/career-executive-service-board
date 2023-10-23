<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentCenter extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblAC";

    protected $fillable = [

        'acno',
        'acdate', // assessment center date
        'numtakes', // number of takes
        'docdate', // document date
        'competencies_d_o',
        'remarks', 
        'encoder',

    ];

    public function erisTblMainAssessmentCenter(): BelongsTo
    {
        return $this->belongsTo(EradTblMain::class, 'acno');
    }
}
