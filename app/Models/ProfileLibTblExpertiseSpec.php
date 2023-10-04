<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblExpertiseSpec extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "profilelib_tblExpertiseSpec";

    protected $primaryKey = 'SpeExp_Code';

    protected $fillable = [
        'SpeExp_Code',
        'Title',
    ]; 
}
