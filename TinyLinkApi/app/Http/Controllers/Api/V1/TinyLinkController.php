<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\LinkMap;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TinyLinkController extends Controller
{
    public function create(Request $request)
    {
        try {
            $link = $request->get('link');
            $tinyLink = Str::random(7);
            $expirationDate = $request->get('expiration_date');
            $link_map = LinkMap::create([
                'tiny_link' => $tinyLink,
                'expiration_date' => $expirationDate,
                'is_active' => true,
            ]);

            return $this->successResponse(['tiny_link' => $tinyLink], 'Link created successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create link', 500);
        }
    }
}
