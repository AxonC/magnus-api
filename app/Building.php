<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $guarded = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}