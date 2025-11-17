<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TinyLinkApiResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'origin_link' => $this->origin_link,
            'tiny_link' => $_ENV['TINY_DOMAIN'] . '/' . $this->tiny_link,
            'expiration_date' => $this->expiration_date
                ? Carbon::make($this->expiration_date)->format('Y-m-d H:i')
                : Carbon::now()->addMonth()->format('Y-m-d H:i'),
            'is_active' => $this->is_active,
        ];
    }
}
