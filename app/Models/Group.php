<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class, 'groups_id');
    }
    public function shedule()
    {
        return $this->belongsTo('App\Shedule');
    }
}
