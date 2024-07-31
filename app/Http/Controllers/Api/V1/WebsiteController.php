<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WebsiteResource;
use App\Http\Requests\Api\V1\Website\IndexRequest;
use App\Http\Requests\Api\V1\Website\StoreRequest;
use App\Services\V1\Contracts\WebsiteServiceInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
            ->setStatusCode(HttpResponse::HTTP_CREATED);
    }

    public function show($id): WebsiteResource
    {
        $website = $this->websiteService->getById($id);

        return new WebsiteResource($website);
    }

    public function update(StoreRequest $request, $id): Response
    {
        $this->websiteService->update($id, $request->validated());

        return response()->noContent();
    }

    public function destroy($id): Response
    {
        $this->websiteService->delete($id);

        return response()->noContent();
    }

    public function websiteReports(int $id): JsonResponse
    {
        $res = $this->websiteService->websiteReports($id);

        return response()->json($res);
    }
}
