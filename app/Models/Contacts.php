<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $table ="profile_tblContact";

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'official_email',
        'official_mobile_number1',
        'official_mobile_number2',
        'personal_mobile_number1',
        'personal_mobile_number2',
        'office_telephone_number',
        'encoder',

    ];

    public function contactsPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
