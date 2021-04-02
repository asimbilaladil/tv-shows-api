<?php


namespace App\Repository;


use App\Models\Show;

class DatabseRepository implements DatabaseRepositoryInterface
{

    public function fetchAll(int $limit)
    {
        return Show::select('*')->paginate($limit);
    }

    public function findByName(string $name, int $limit)
    {
        $shows =  Show::select('*')->where('name','like', "%$name%")->paginate($limit);
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
