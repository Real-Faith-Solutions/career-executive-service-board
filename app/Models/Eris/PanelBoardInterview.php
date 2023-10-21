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
        'dteassign', // date assigned
        'dtesubmit', // date submit
        'intrviewer', // interviewer
        'dteiview', // date interview
        'recom', // recommendation
        'encoder',

    ];

    public function getUserPanelBoardInterview($ctrlno)
    {
        $panelBoardInterview = PanelBoardInterview::find($ctrlno);

        $dateFrom = $panelBoardInterview->dteassign;
        $dateTo = $panelBoardInterview->dtesubmit;
        $dateInterview = $panelBoardInterview->dteiview;

        return [
            'dateFrom' => $dateFrom, 
            'dateTo' => $dateTo, 
            'panelBoardInterview' => $panelBoardInterview,
            'dateInterview' => $dateInterview,
        ];
    }

    public function erisTblMainPanelBoardInterview(): BelongsTo
    {
        return $this->belongsTo(EradTblMain::class, 'acno');
    }
}
