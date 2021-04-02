<?php


namespace App\Repository;


interface TVShowsRepositoryInterface
{

    public function fetchAll(int $limit);

    public function findByName(string $name);
}
