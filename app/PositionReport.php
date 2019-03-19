<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionReport extends Model
{
    protected $guarded = [];

    protected $dates = ['timestamp'];

    public $timestamps = false;
}
