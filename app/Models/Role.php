<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assignPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('permission_name', $permission)->firstOrFail();
        }

        $this->permissions()->syncWithoutDetaching($permission);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('permission_name', $permission);
    }

}
