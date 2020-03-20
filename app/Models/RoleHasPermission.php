<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class );
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
