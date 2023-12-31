<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpouseRecords extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profile_tblSpouseRecords";
    protected $primaryKey = 'ctrlno';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'name_extension',
        'occupation',
        'employer_business_name',
        'employer_business_address',
        'employer_business_telephone',
        'encoder',
    ];

    public function childrenPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }
}
