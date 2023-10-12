<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EradTblMain extends Model
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

    public function search($search)
    {
        $erisTblMain = EradTblMain::query()
        ->where('acno', "LIKE" ,"%$search%")
        ->orWhere('cesno',  "LIKE","%$search%")
        ->orWhere('acbatchno',  "LIKE","%$search%")
        ->orWhere('lastname',  "LIKE","%$search%")
        ->orWhere('firstname',  "LIKE","%$search%")
        ->orWhere('middlename',  "LIKE","%$search%")
        ->paginate(25);

        return $erisTblMain;
    }

    public function gettingAcNo()
    {
        if (DB::table('erad_tblMain')->count() === 0) 
        {
            $acno = 0;
        } 
        else 
        {
            $acno = EradTblMain::latest()->first()->acno;
        }

        return ++$acno;
    }

    public function gettingAcBacthNo()
    {
        if (DB::table('erad_tblMain')->count() === 0) 
        {
            $acbatchno = 0;
        } 
        else 
        {
            $acbatchno = EradTblMain::latest()->first()->acbatchno;
        }

        return ++$acbatchno;
    }

    public function getUserInfo($acno)
    {
        $erisTblMainPersonalData = EradTblMain::find($acno);
        $birthdate = $erisTblMainPersonalData->birthdate;

        $birthDate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($birthDate);

        return [
            'age' => $age,
            'erisTblMainPersonalData' => $erisTblMainPersonalData
        ];
    }

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
