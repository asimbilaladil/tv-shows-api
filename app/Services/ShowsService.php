<?php

declare(strict_types=1);

namespace App\Services;


use App\Repository\DatabaseRepository;
use App\Repository\TVMazeRepository;

final class ShowsService
{
    private $showsRepository;

    private $databaseRepository;

    public function __construct(TVMazeRepository $tvMazeRepository, DatabaseRepository $databaseRepository)
    {
        $this->showsRepository = $tvMazeRepository;
        $this->databaseRepository = $databaseRepository;
    }

    public function processShows(int $limit): array
    {
        $shows = $this->databaseRepository->fetchAll($limit);

        if (count($shows['data']) > 0) {
            return $shows;
        }

        $limit = $this->processLimit();

        $shows = $this->showsRepository->fetchAll($limit);

        $this->insertShows($shows['data']);

        $shows = $this->databaseRepository->fetchAll($limit);
        return $shows;
    }

    private function processLimit(): int
    {
        $latestRecord = $this->databaseRepository->fetchLatest();
        $limit = $latestRecord->show_id ?? 0;

        return (int) ($limit > 0 ? ceil($latestRecord->show_id / 250) : $limit);
    }

    private function insertShows(array $data): void
    {
        foreach ($data as $show) {
            $show = array_key_exists('show', $show) ? $show['show'] : $show;
            $data = $this->processShowArray($show);
            $this->databaseRepository->insert($data);
        }
    }

    private function processShowArray(array $data): array
    {
        return [
            'show_id' => $data['id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'image' => $data['image']['medium'] ?? '',
            'link' => $data['url'],
        ];
    }

    public function processShowByName(string $name, int $limit, int $currentPage): array
    {
        if ($currentPage === 0) {
            $shows = $this->showsRepository->findByName($name);
            $this->insertShows($shows['data']);
        }

        return $this->databaseRepository->findByName($name, $limit);
    }
}
