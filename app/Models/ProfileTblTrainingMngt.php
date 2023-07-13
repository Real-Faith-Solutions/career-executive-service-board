<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblTrainingMngt extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "profile_tblTrainingMngt";

    protected $fillable = [

        'personal_data_cesno',
        'training',
        'subject',
        'sponsor',
        'venue',
        'from_dt',
        'to_dt',
        'classcode',
        'encoder',

    ];

}
