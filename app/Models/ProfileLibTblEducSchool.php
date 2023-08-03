<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblEducSchool extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profilelib_tblEducSchools";
    protected $primaryKey = 'CODE';

    protected $fillable = [
        'CODE',
        'SCHOOL',
    ];

}
