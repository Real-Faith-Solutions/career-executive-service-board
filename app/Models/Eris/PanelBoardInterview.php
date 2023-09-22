<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PanelBoardInterview extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblPBOARD";

    protected $fillable = [

        'acno',
        'dteassign',
        'dtesubmit',
        'intrviewer',
        'dteiview',
        'recom',
        'encoder',

    ];

    public function erisTblMainPanelBoardInterview(): BelongsTo
    {
        return $this->belongsTo(ErisTblMain::class, 'acno');
    }
}
