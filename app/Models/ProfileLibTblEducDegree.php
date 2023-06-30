<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblEducDegree extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblEducDegree";

    protected $fillable = [
        'CODE',
        'DEGREE',
    ]; 
}
