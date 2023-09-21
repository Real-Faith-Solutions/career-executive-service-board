<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ErisTblMain extends Model
{
    use HasFactory;

    protected $primaryKey = 'acno';

    protected $table = "erad_tblMain";

    protected $fillables = [

        'acbatchno',
        'lastname',
        'firstname',
        'middlename',
        'position',
        'position_remarks',
        'department',
        'office',
        'c_status',
        'c_date',
        'c_resno',
        'we_date',
        'wlocation',
        'werating',
        'we_remarks',
        'encoder',
        'e_date',
        'picture',
        'contactno',
        'faxno',
        'mobileno',
        'gender',
        'birthdate',
        'emailadd',
        'cesno',
        'maddress',

    ];

    public function writtenExam(): HasMany
    {
        return $this->hasMany(WrittenExam::class, 'acno');
    }

}
