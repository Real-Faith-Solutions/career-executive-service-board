<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblEducMajor extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblEducMajor";

    protected $fillable = [
        'CODE',
        'COURSE',
    ]; 
}
