<?php

declare(strict_types=1);

namespace App\Repository;


interface TVShowsRepositoryInterface
{

    public function fetchAll(int $limit): array;

    public function findByName(string $name): array;
}
