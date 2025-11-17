<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkMap extends Model
{
    use SoftDeletes;

    protected $table = 'link_maps';
    protected $fillable = [
        'origin_link',
        'tiny_link',
        'expiration_date',
        'user_id',
        'is_active',
    ];

}
