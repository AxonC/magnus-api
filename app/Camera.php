<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $guarded = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function findByToken($token)
    {
        return $this->where('token', $token)->firstOrFail();
    }
}
