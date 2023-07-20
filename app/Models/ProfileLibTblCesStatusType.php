<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblCesStatusType extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "profilelib_tblcesstatustype";

    protected $primaryKey = 'code';

    protected $fillable = [

        'code',
        'description',

    ]; 

    public function cesStatusTypeLibraryPersonalData(): BelongsToMany
    {
        return $this->belongsToMany(PersonalData::class, 'profile_tblCESstatus', 'type_code', 'cesno')
        ->as('profile_tblCESstatus')
        ->withTimestamps();
    }

}
