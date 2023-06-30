<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblLanguageRef extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblLanguageRef";

    protected $fillable = [
        'code',
        'title',
    ]; 
}
