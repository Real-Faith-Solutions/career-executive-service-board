<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblregion extends Model
{
    use HasFactory;
    protected $fillable = [
        'reg_code',
        'name',
        'acronym',
        'zipcode',
        'regionSeq',
    ]; 
}
