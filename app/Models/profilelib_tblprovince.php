<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblprovince extends Model
{
    use HasFactory;
    protected $fillable = [
        'prov_code',
        'reg_code',
        'name',
        'zipcode',
    ]; 
}
