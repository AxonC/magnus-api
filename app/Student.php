<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'internal_identifier';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function person()
    {
    	return $this->belongsTo(Person::class, 'identifier');
    }

    public function getLastPositionAttribute()
    {

    }
}
