<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblEducSchool extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblEducSchools";

    protected $primaryKey = 'CODE';

    protected $fillable = [
        'CODE',
        'SCHOOL',
    ]; 
    
}
