<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblExamRef extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblExamRef";

    protected $fillable = [
        'CODE',
        'TITLE',
    ]; 
}
