<?php


namespace Tests\Unit\Repository;


use App\Models\Show;
use App\Repository\DatabaseRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabseRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use HasFactory;
    private $databseRepository;

    public function setUp(): void
    {
        $this->databseRepository = new DatabaseRepository();
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testFetchAll()
    {
        Show::factory()->count(3)->create();
        $result = $this->databseRepository->fetchAll(3);

        $this->assertEquals(count($result['data']), 3);
    }

    public function testFindByName()
    {
        $show       = Show::factory()->create();
        $name       = $show['name'];
        $result     = $this->databseRepository->findByName($name, 1);
        $expected   = $show['name'];

        $this->assertEquals($expected, $result['data'][0]['name']);
    }

    public function testInsert()
    {
        $show = Show::factory()->make();
        $data = [
            'name'      => $show['name'],
            'image'     => $show['image'],
            'link'      => $show['link'],
            'show_id'   => $show['show_id'],
            'status'    => $show['status'],
        ];

        $this->databseRepository->insert($data);
        $this->assertDatabaseHas('shows', $data);
    }

    public function testFetchLatest()
    {
        $show       = Show::factory()->count(5)->create();
        $result     = $this->databseRepository->fetchLatest();
        $expected   = $show[4]['id'];

        $this->assertEquals($expected, $result['id']);
    }
}
