<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildrenRecords extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $primaryKey = 'ctrlno';

    protected $table= 'profile_tblChildren';

    protected $fillable = [
        'cesno',
        'fname',
        'mname',
        'lname',
        'bdate',
        'gender',
        'encoder',
    ];
    
    public function personalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}