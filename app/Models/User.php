<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'contact_no',
        'email',
        'employee_id',
        'username',
        'role',
        'role_name_no',
        'password',
        'is_active',
        'picture',
        'cesno',
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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles->pluck('name')->contains($role);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function assignRole($role)
    {
        return $this->roles()->sync($role);
    }

    public function assignPermission($permission)
    {
        return $this->permissions()->sync($permission);
    }

}