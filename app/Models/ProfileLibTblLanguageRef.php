<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblLanguageRef extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profilelib_tblLanguageRef";

    protected $primaryKey = 'code';

    protected $fillable = [

        'code',
        'title',

    ]; 
}
