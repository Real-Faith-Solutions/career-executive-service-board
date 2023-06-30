<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblAreaCode extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblareacode";

    protected $fillable = [
        'CODE',
        'NAME',
        'ZIPCODE',
    ]; 
}
