<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblAppAuthority extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profilelib_tblappAuthority";

    protected $primaryKey = 'code';

    protected $fillable = [

        'code',
        'description',

    ]; 

    public function appAuthorityLibrary()
    {
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

        return $profileLibTblAppAuthority;
    }
}
