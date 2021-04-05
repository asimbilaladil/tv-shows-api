<?php

declare(strict_types=1);

namespace App\Repository;


interface DatabaseRepositoryInterface
{
    public function fetchAll(int $limit): array;

    public function findByName(string $name, int $limit): array;

    public function updateOrCreate($data): array;

    public function fetchLatest(): array;
}
