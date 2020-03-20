<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function departments()
    {
        return $this->hasMany(Department::class)->withTrashed();
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }

    protected static function boot()
    {
        parent::boot();

//        static::deleting(function ($faculty) {
//            $faculty->departments()->delete();
//        });
    }
}
