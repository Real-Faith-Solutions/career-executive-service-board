<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblExpertiseGen extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblExpertiseGen";

    protected $fillable = [
        'GenExp_Code',
        'Title',
    ]; 
}
