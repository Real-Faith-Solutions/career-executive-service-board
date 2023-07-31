<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Identification extends Model
{
    
    use HasFactory;

    protected $primaryKey = 'ctrlno';

    protected $table = "identifications";

    use SoftDeletes;

    protected $fillable = [
        
        'personal_data_cesno',
        // 'type',
        // 'id_number',
        'gsis',
        'pagibig',
        'philhealth',
        'sss_no',
        'tin',
        'encoder',

    ];

    public function identificationPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
