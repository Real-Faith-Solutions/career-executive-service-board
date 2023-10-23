<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankTracker201 extends Model
{
    use HasFactory;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'ctrlno';

    public $table = 'erad_tblRankTracker201';

    protected $fillable = [
        'cesno',
        'r_catid',
        'r_ctrlno',
        'description',
        'remarks',
        'submit_dt',
        'encoder',
        'lastupd_enc',
    ];
}
