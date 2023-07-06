<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpouseRecords extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $primaryKey = 'ctrlno';

    protected $table = "spouse_records";

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


    // protected static function boot()
    // {
    //     parent::boot();

    //     SpouseRecords::creating(function($model) {
    //         $model->age_sn_fp = Carbon::parse($model->birthdate_sn_fp)->age;
    //     });
    // }

}
