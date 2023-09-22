<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceVerification extends Model
{
    protected $table = 'device_verification'; // Specify the table name

    protected $fillable = [
        'user_ctrlno',
        'confirmation_code', 
        'device_id', 
        'verified', 
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_ctrlno', 'ctrlno');
    }

}
