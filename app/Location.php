<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'latitude', 'longitude', 'user_id',
    ];

    public function user_from_location ()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
