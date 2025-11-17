<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Actions\V1\FetchTinyLinkAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\TinyLinkFormRequest;
use App\Http\Resources\V1\TinyLinkApiResource;
use App\Models\LinkMap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TinyLinkController extends Controller
{
    /**
     * paginated resource of tiny links
     *
     * @param Request $request
     * @param FetchTinyLinkAction $fetchTinyLinkAction
     * @return JsonResponse
     */
    public function index(Request $request, FetchTinyLinkAction $fetchTinyLinkAction)
    {
        try {
            $paginatedTinyLinks = $fetchTinyLinkAction->execute($request);
            logger()->info("tinyLinks: fetch paginated data");

            return $this->paginatedResponse(
                data: TinyLinkApiResource::collection($paginatedTinyLinks),
                message: 'Tiny Links fetched successfully'
            );
        } catch (\Exception $e) {
            logger()->critical("tinyLinks: failed to fetch tiny links: {$e->getMessage()}");
            return $this->errorResponse(message: 'Failed to fetch tiny links', code: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TinyLinkFormRequest $request
     * @return JsonResponse
     */
    public function store(TinyLinkFormRequest $request)
    {
        try {
            $link_map = LinkMap::query()->create($request->fields());
            logger()->info("tinyLinks: link created successfully");

            return $this->successResponse(
                data: new TinyLinkApiResource($link_map),
                message: 'Link created successfully',
                code: Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            logger()->critical("tinyLinks: failed to create link: {$e->getMessage()}");

            return $this->errorResponse(message: 'Failed to create link', code: 500);
        }
    }
}
