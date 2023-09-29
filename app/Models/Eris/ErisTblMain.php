<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErisTblMain extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'acno';

    protected $table = "erad_tblMain";

    protected $fillable = [

        'acbatchno',
        'lastname', // identified
        'firstname', // identified
        'middlename', // identified
        'position', // identified
        'position_remarks', // identified
        'department', // department/agency and identified
        'office', // bureau office and identified
        'c_status', // conferment status and identified
        'c_date', // date conferred
        'c_resno', // resolution no and identified
        'we_date',
        'wlocation',
        'werating',
        'we_remarks',
        'encoder', // identified
        'e_date',
        'picture', // identified
        'contactno', // telephone no and identified
        'faxno', // identified
        'mobileno', // identified
        'gender', // identified
        'birthdate', // identified
        'emailadd',  // identified
        'cesno', // identified
        'maddress',

    ];

    public function writtenExam(): HasMany
    {
        return $this->hasMany(WrittenExam::class, 'acno');
    }

    public function assessmentCenter(): HasMany
    {
        return $this->hasMany(AssessmentCenter::class, 'acno');
    }

    public function rapidValidation(): HasMany
    {
        return $this->hasMany(RapidValidation::class, 'acno');
    }

    public function inDepthValidation(): HasMany
    {
        return $this->hasMany(InDepthValidation::class, 'acno');
    }

    public function panelBoardInterview(): HasMany
    {
        return $this->hasMany(PanelBoardInterview::class, 'acno');
    }

    public function boardInterview(): HasMany
    {
        return $this->hasMany(BoardInterView::class, 'acno');
    }

    public function rankTracker(): HasMany
    {
        return $this->hasMany(RankTracker::class, 'acno');
    }
}
