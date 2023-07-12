<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileAddress extends Model
{
    protected $table = 'profile_tblAddress';
    protected $primaryKey = 'ctrlno';

    protected $fillable = [
        'personal_data_cesno',
        'type',
        'region',
        'city_or_municipality',
        'brgy',
        'zip_code',
        'street_lot_bldg_floor',
        'encoder',
        'last_updated_by',
    ];

    public function profileAddressPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
//
