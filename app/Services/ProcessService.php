<?php


namespace App\Services;


use App\Models\Schedule;
use App\Repository\DatabseRepository;
use App\Repository\TVMazeRepository;

class ProcessService
{
    private $tvMazeRepository;

    private $databseRepository;

    public function __construct(TVMazeRepository $tvMazeRepository, DatabseRepository $databseRepository)
    {
        $this->tvMazeRepository    = $tvMazeRepository;
        $this->databseRepository   = $databseRepository;
    }

    public function processShows(int $limit): array
    {


        $shows = $this->databseRepository->fetchAll($limit);

        if(count($shows['data']) > 0){

            return $shows;
        }

        $limit = $this->processLimit();

        $shows = $this->tvMazeRepository->fetchAll($limit);

        foreach ($shows['data'] as $show){
            $data = $this->processShowArray($show);
            $this->databseRepository->insert($data);

        }

        $shows = $this->databseRepository->fetchAll($limit);
        return $shows;
    }

    public function processShowByName(string $name, int $limit, int $currentPage): array
    {

        if($currentPage === 0){
            $shows = $this->tvMazeRepository->findByName($name);
            foreach ($shows['data'] as $show) {
                $data = $this->processShowArray($show['show']);
                $this->databseRepository->insert($data);
            }
        }

        $show = $this->databseRepository->findByName($name, $limit);

        return $show;
    }

    private function processLimit(): int
    {

        $latestRecord   = $this->databseRepository->fetchLatest();
        $limit          = $latestRecord->show_id ?? 0;

        return $limit > 0 ? ceil($latestRecord->show_id / 250) : $limit;
    }

    private function processShowArray(array $data): array
    {
        return [
            'show_id'   => $data['id'],
            'name'      => $data['name'],
            'status'    => $data['status'],
            'image'     => $data['image']['medium'] ?? '',
            'link'      => $data['url'],
        ];
    }
}
