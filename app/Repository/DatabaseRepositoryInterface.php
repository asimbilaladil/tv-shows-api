<?php

declare(strict_types=1);

namespace App\Repository;


interface DatabaseRepositoryInterface
{
    public function fetchAll(int $limit);

    public function findByName(string $name, int $limit);

    public function insert($data);

    public function fetchLatest();
}
