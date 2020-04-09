<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketHistory extends Model
{
    protected $fillable = [
        'ticket_id', 'user_id', 'status', 'details',
    ];

    public function user_name_from_history()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }
}
