<?php


namespace App\Repository;


use App\Models\Show;

class DatabseRepository implements DatabaseRepositoryInterface
{

    public function fetchAll(int $limit)
    {
        $shows = Show::select('name', 'show_id', 'image', 'link')->paginate($limit);
        return (json_decode(json_encode($shows), true));
    }

    public function findByName(string $name, int $limit)
    {
        $shows =  Show::select('name', 'show_id', 'image', 'link')->where('name','like', "%$name%")->paginate($limit);
        return (json_decode(json_encode($shows), true));
    }

    public function insert($data)
    {
        return Show::updateOrCreate($data);
    }

    public function fetchLatest()
    {
        return Show::latest('id')->first();
    }
}
