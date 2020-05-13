<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [
      'created_from', 'department', 'details', 'priority', 'assing_to',
    ];

    public function user_group()
    {
        return $this->belongsTo(User_group::class, 'department', 'id')->withDefault();
    }

    public function user_from_ticket()
    {
        return $this->belongsTo(User::class, 'created_from', 'id');
    }

    public function user_name_from_ticket()
    {
        return $this->belongsTo(User::class, 'assing_to', 'id')->withDefault();
    }

    public function history_from_ticket()
    {
        return $this->hasMany(TicketHistory::class, 'ticket_id', 'id');
    }

    // Not Used
    public function user_role_from_history()
    {
        return $this->belongsTo(User_role::class, 'user_id', 'id');
    }
}
