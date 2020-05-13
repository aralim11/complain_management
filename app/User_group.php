<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_group extends Model
{

    protected $fillable = [
        'name', 'slug',
    ];

    public function group_count()
    {
        return $this->hasMany(Ticket::class, 'department', 'id');
    }

    public function group_solve_count()
    {
        return $this->group_count()->where('status', '=', '4');
    }
}
