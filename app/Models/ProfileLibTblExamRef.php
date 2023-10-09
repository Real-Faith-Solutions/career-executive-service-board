<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblExamRef extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profilelib_tblExamRef";

    protected $primaryKey = 'CODE';

    protected $fillable = [
        'CODE',
        'TITLE',
    ]; 

}
