<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblEducMajor extends Model
{
    use HasFactory;
    protected $fillable = [
        'CODE',
        'COURSE',
    ]; 
}
