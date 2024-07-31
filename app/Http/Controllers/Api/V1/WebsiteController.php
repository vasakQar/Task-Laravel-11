<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Website;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WebsiteResource;
use App\Http\Requests\Api\V1\Website\IndexRequest;
use App\Http\Requests\Api\V1\Website\StoreRequest;
use App\Services\V1\Contracts\WebsiteServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class WebsiteController extends Controller
{
    protected WebsiteServiceInterface $websiteService;

    public function __construct(WebsiteServiceInterface $websiteService)
    {
        $this->websiteService = $websiteService;
    }

    public function index(IndexRequest $request): AnonymousResourceCollection
    {
        $res = $this->websiteService->getAll($request->validated());

        return WebsiteResource::collection($res);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $website = $this->websiteService->create($request->validated());

        return (new WebsiteResource($website))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Website $website): WebsiteResource
    {
        return new WebsiteResource($website);
    }

    public function update(StoreRequest $request, Website $website): Response
    {
        $this->websiteService->update($website, $request->validated());
        return response()->noContent();
    }

    public function destroy(Website $website): Response
    {
        $this->websiteService->delete($website->id);
        return response()->noContent();
    }
}
