<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileTblCesStatus extends Pivot
{
    use HasFactory;

    protected $table = "profile_tblCESstatus";
    
    protected $primaryKey = 'ctrlno';

    protected $fillable = [
        
        'personal_data_cesno',
        'profilelib_tblcesstatus_code',
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

    ];

}