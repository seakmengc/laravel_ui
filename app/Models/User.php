<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, SoftDeletes;

    protected $guarded = [];

    public function identity()
    {
        return $this->hasOne(Identity::class)->withTrashed();
    }

    public function user_roles() {

        return $this->hasMany(UserRole::class, 'model_id', 'id');
    }

    public function courses_taking()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function courses_teaching()
    {
        return $this->hasMany(Course::class, 'taught_by', 'id');
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }

    protected static function boot()
    {
        parent::boot();

//        static::restoring(function ($user) {
//            $user->identity()->restore();
//            $user->restore();
//        });
//
//        static::deleting(function ($user) {
//            $user->identity()->delete();
//            $user->user_roles()->delete();
//            $user->delete();
//        });
    }
}
