<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProfileTblCesStatus extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = "profile_tblCESstatus";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'cesstat_code',
        'acc_code',
        'type_code',
        'official_code',
        'resolution_no',
        'appointed_dt',
        'submit_dt',
        'return_dt',
        'validator',
        'remarks',
        'encoder',
        'lastupd_enc',

    ];

    public function latestCesStatusCode($cesno)
    {
        // retrieving latest ces status thru date appointed_dt
        $cestatusCode = ProfileTblCesStatus::orderBy('appointed_dt', 'desc')
            ->value('cesstat_code');

        if(!$cestatusCode)
        {
            $cestatusCode = null;
        }

        // update CESStat_code based on $latestCestatusCode
        $latestCesStatusCode =  DB::table('profile_tblMain')
            ->where('cesno', $cesno)
            ->update(['CESStat_code' => $cestatusCode]);

        return $latestCesStatusCode;
    }

    public function profileLibTblCesStatus(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblCesStatus::class, 'cesstat_code');
    }

    public function profileLibTblCesStatusAcc(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblCesStatusAcc::class, 'acc_code');
    }

    public function profileLibTblCesStatusType(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblCesStatusType::class, 'type_code');
    }

    public function profileLibTblAppAuthority(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblAppAuthority::class, 'official_code');
    }

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'cesno');
    }
}
