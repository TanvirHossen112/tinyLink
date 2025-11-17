<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkMap extends Model
{
    use SoftDeletes;

    protected $table = 'link_maps';
    protected $fillable = [
        'origin_link',
        'tiny_link',
        'expiration_date',
        'is_active',
        'created_by',
    ];

    /**
     * @return HasMany
     */
    public function clickEvents(): HasMany
    {
        return $this->hasMany(ClickEvent::class, 'link_map_id')->orderBy('created_at', 'desc');
    }
}
