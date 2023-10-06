<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblExpertiseGen extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'GenExp_Code';

    protected $table = "profilelib_tblExpertiseGen";

    protected $fillable = [
        'Title',
        'encoder',
        'updated_by',
    ]; 
}
