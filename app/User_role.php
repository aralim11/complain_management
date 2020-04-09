<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    public function users()
    {
        return $this->hasMany(User_role::class, 'user_role' , 'id');
    }
}
