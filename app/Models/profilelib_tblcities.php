<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblcities extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_code',
        'prov_code',
        'name',
        'zipcode',
    ]; 
}
