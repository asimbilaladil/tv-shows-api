<?php

declare(strict_types=1);

namespace App\Repository;

use App\Services\HttpService;
use Illuminate\Support\Facades\Config;

class TVMazeRepository implements TVShowsRepositoryInterface
{
    private $shows;

    private $searchShow;

    private $httpService;

    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
        $this->shows = Config::get('shows.shows');
        $this->searchShow = Config::get('shows.search_shows');
    }

    public function fetchAll(int $limit): array
    {
        return $this->httpService->getData($this->shows, ['page' => $limit]);
    }

    public function findByName(string $name): array
    {
        return $this->httpService->getData($this->searchShow, ['q' => $name]);
    }
}
