<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblCities extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcities";
    
    protected $fillable = [
        'city_code',
        'prov_code',
        'name',
        'zipcode',
    ]; 
}
