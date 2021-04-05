<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ShowsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class APIController extends Controller
{
    private $processService;

    private $defaultShowsLimit;

    public function __construct(ShowsService $processService)
    {
        $this->processService = $processService;
        $this->defaultShowsLimit = Config::get('tvmaze.shows_limit');
    }

    public function shows(Request $request): JsonResponse
    {
        $limit = (int)$request->get('limit') ?? $this->defaultShowsLimit;

        return new JsonResponse(
            [
                "data" => $this->processService->processShows($limit),
                "status" => Response::HTTP_CREATED
            ], Response::HTTP_CREATED
        );
    }


    public function showByName(Request $request): JsonResponse
    {
        $limit = (int)$request->get('limit') ?? $this->defaultShowsLimit;
        $name = $request->get('q');
        $currentPage = (int)($request->has('page') ? $request->get('page') : 0);

        return new JsonResponse(
            [
                "data" => $this->processService->processShowByName($name, $limit, $currentPage),
                "status" => Response::HTTP_CREATED
            ], Response::HTTP_CREATED
        );
    }
}
