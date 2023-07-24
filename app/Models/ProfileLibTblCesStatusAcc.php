<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProfileLibTblCesStatusAcc extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcesstatusAcc";

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'description',
    ]; 

}
