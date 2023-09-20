<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WrittenExam extends Model
{
    use HasFactory;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_tblWExam";

    protected $fillable = [

        'acno', // account number from erad_tblMain
        'we_date', // written exam date
        'we_location', // written exam location
        'we_rating', // written exam rating
        'we_remarks', // written exam remarks
        'encoder',

    ];

    public function erisTblMainWrittenExam(): BelongsTo
    {
        return $this->belongsTo(ErisTblMain::class);
    }

}
