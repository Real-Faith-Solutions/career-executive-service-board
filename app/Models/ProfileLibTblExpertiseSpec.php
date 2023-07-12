<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblExpertiseSpec extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblExpertiseSpec";

    protected $primaryKey = 'SpeExp_Code';

    protected $fillable = [
        'SpeExp_Code',
        'Title',
    ]; 
}
