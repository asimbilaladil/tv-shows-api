<?php


namespace App\Repository;


use App\Services\HttpService;
use Illuminate\Support\Facades\Config;

class TVMazeRepository implements TVShowsRepositoryInterface
{


    private $shows;

    private $searchShow;


    public function __construct(HttpService $httpService)
    {
        $this->httpService  = $httpService;
        $this->shows        = Config::get('tvmaze.shows');
        $this->searchShow   = Config::get('tvmaze.search_shows');
    }

    public function fetchAll(int $limit)
    {
       return $this->httpService->getData($this->shows, ['page' => $limit]);
    }

    public function findByName(string $name)
    {
        return $this->httpService->getData($this->searchShow, ['q' => $name]);
    }
}
