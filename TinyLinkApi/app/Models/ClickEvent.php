<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickEvent extends Model
{
    protected $table = 'click_events';
    protected $fillable = [
        'link_map_id',
        'time',
        'ip_address',
        'user_agent',
        'other_details',
    ];
}
