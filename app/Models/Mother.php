<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mother extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table = 'mothers';

    protected $fillable = [

        'personal_data_cesno',
        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'encoder',

    ];

    public function MotherPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
