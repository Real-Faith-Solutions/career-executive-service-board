<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RankTracker extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblranktracker";

    protected $fillable = [

        'acno',
        'r_catid',
        'r_ctrlno',
        'description',
        'remarks',
        'submit_dt',
        'cesstatus',
        'encoder',

    ];

    public function erisTblMainRankTracker(): BelongsTo
    {
        return $this->belongsTo(ErisTblMain::class, 'acno');
    }
}
