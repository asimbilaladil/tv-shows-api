<?php

declare(strict_types=1);

namespace App\Repository;


use App\Models\Show;

class DatabaseRepository implements DatabaseRepositoryInterface
{

    public function fetchAll(int $limit): array
    {
        $shows = Show::select('name', 'show_id', 'image', 'link')->paginate($limit);
        return (json_decode(json_encode($shows), true));
    }

    public function findByName(string $name, int $limit): array
    {
        $shows = Show::select('name', 'show_id', 'image', 'link')->where('name', 'like', "%$name%")->paginate($limit);
        return (json_decode(json_encode($shows), true));
    }

    public function updateOrCreate($data): array
    {
        $show = Show::updateOrCreate($data);
        return (json_decode(json_encode($show), true));
    }

    public function fetchLatest(): array
    {
        $show = Show::latest('id')->first() ?? [];
        return (json_decode(json_encode($show), true));
    }
}
