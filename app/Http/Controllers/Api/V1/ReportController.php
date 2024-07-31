<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\Contracts\ReportServiceInterface;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    protected ReportServiceInterface $reportService;

    public function __construct(ReportServiceInterface $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(): JsonResponse
    {
        $res = $this->reportService->getAll();

        return response()->json($res);
    }
}
