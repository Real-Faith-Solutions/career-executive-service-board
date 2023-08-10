<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [
        
        'personal_data_cesno',
        'contact_no',
        'email',
        'password',
        'role',
        'role_name_no',
        'is_active',
        'encoder',
        'last_updated_by',
        'default_password_change',
        'email_verified_at',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usersPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
