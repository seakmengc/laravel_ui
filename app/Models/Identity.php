<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Identity extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getFullNameAttribute()
    {
        if (isset($this->first_name) && isset($this->last_name))
            return $this->first_name . ' ' . $this->last_name;
        return '';
    }

    public function getDateOfBirthAttribute()
    {
        if (isset($this->dob))
            return date('d-M-Y', strtotime($this->dob));

        return '';
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
