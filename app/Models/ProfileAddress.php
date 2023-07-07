<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileAddress extends Model
{
    protected $table = 'profile_tblAddress';
    protected $fillable = [
        'cesno',
        'type',
        'floor_bldg',
        'no_street',
        'region',
        'city_or_municipality',
        'brgy_or_district',
        'zip_code',
        'encoder',
        'last_updated_by',
    ];
}
//
