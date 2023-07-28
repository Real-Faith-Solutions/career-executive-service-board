<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfileLibTblCesStatus extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcesstatus";

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'description',
    ];
    
}
