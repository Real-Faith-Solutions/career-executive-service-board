<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardInterView extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblBOARD";

    protected $fillable = [
        
        'acno', // foreign key, reference on erad_TblMain, in Model EradTblMain
        'dteassign', // date assigned
        'dtesubmit', // date submit
        'intrviewer', // interviewer
        'dteiview', // date interview
        'recom', // recommendation
        'encoder',

    ];

    public function getUserBoardInterview($ctrlno)
    {
        $boardInterview = BoardInterView::find($ctrlno);

        $dateFrom = $boardInterview->dteassign;
        $dateTo = $boardInterview->dtesubmit;
        $dteiview = $boardInterview->dteiview;

        return [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'dteiview' => $dteiview,
            'boardInterview' => $boardInterview,
        ];
    }

    public function erisTblMainBoardInterview(): BelongsTo
    {
        return $this->belongsTo(EradTblMain::class, 'acno');
    }
}
