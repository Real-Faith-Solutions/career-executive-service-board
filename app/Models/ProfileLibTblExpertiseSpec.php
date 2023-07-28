<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblExpertiseSpec extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "profilelib_tblExpertiseSpec";

    protected $primaryKey = 'SpeExp_Code';

    protected $fillable = [
        'SpeExp_Code',
        'Title',
    ]; 

    public function expertisePersonalData(): BelongsToMany
    {
        return $this->belongsToMany(PersonalData::class, 'profile_tblExpertise', 'personal_data_cesno', 'specialization_code')
        ->as('profile_tblExpertise')
        ->withPivot('ctrlno', 'encoder')
        ->withTimestamps();
    }

}
