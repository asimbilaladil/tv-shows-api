<?php

namespace App\Http\Controllers;

use App\Services\ProcessService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class APIController extends Controller
{
    private $processService;

    private $defaultShowsLimit;

    public function __construct(ProcessService $processService)
    {
        $this->processService       = $processService;
        $this->defaultShowsLimit    = Config::get('tvmaze.shows_limit');
    }

    public function shows(Request $request)
    {

        $limit  = $request->get('limit') ?? $this->defaultShowsLimit;

        return new JsonResponse([
            "data" => $this->processService->processShows($limit),
            "status" => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);

    }


    public function showByName(Request $request)
    {
        $limit          = $request->get('limit') ?? $this->defaultShowsLimit;
        $name           = $request->get('q');
        $currentPage    = $request->has('page') ? $request->get('page') : 0;
        return new JsonResponse([
            "data" => $this->processService->processShowByName($name, $limit, $currentPage),
            "status" => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);

    }
}
