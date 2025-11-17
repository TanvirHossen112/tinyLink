<?php

namespace App\Http\Actions\V1;

use App\Models\LinkMap;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FetchTinyLinkAction
{
    /**
     * Fetch paginated tiny link
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function execute(Request $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        return LinkMap::query()
            ->withCount('clickEvents')
            ->orderByDesc('id')
            ->paginate(5);
    }
}
