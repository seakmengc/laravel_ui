<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use function foo\func;

class Course extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getAcademicY1Attribute()
    {
        return explode('-', $this->academic)[0];
    }

    public function getAcademicY2Attribute()
    {
        return explode('-', $this->academic)[1];
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function students()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'taught_by', 'id');
    }

    protected static function boot()
    {
        parent::boot();

//        static::restoring(function ($course) {
//            $course->department()->restore();
//        });
//
//        static::deleting(function ($course) {
//            $course->students()->delete();
//            $course->taught_by = null;
//            $course->save();
//            $course->delete();
//        });
    }

}
