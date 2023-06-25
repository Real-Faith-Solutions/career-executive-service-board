<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblEducDegree extends Model
{
    use HasFactory;
    protected $fillable = [
        'CODE',
        'DEGREE',
    ]; 
}
