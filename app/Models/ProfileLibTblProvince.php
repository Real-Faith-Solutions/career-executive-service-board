<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblProvince extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblprovince";

    protected $fillable = [
        'prov_code',
        'reg_code',
        'name',
        'zipcode',
    ]; 
}
