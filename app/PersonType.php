<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonType extends Model
{
    public $timestamps = false;
    protected $table = 'persons_type';
    protected $guarded = [];
    protected $dates = [];
}
