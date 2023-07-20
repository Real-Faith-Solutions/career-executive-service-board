<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProfileLibTblCesStatus extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcesstatus";

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'description',
    ];
    
    public function cesSatusLibraryPersonalData(): BelongsToMany
    {
        return $this->belongsToMany(PersonalData::class, 'profile_tblCESstatus', 'cesstat_code', 'cesno')
        ->as('profile_tblCESstatus')
        ->withTimestamps();
    }

}
