<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'identifier';
    protected $casts = ['identifier' => 'string'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function getLastPositionAttribute()
    // {

    // }
}
