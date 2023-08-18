<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    protected $primaryKey = 'ctrlno'; // Specify the custom primary key

    public function userPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

    protected $fillable = [
        'contact_no',
        'email',
        'password',
        'is_active',
        'last_updated_by',
        'encoder',
        'default_password_change',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users')
        ->withTimestamps();
    }

    public function hasRole($role)
    {
        return $this->roles->contains('role_name', $role);
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('role_name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }

}