<?php


namespace Tests\Unit\Repository;


use App\Models\Show;
use App\Repository\DatabseRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class DatabseRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use HasFactory;

//    protected $showMock;

//    public function setUp(): void
//    {
////        parent::setUp();
////
////        $this->showMock = Mockery::mock('Show');
////        $this->showMock->id = 1;
//    }

    public function testFetchAll()
    {
        //$databseRepository = new DatabseRepository();
        $show =  Show::factory()->count(3)->make();
        dd($show);
        //dd($databseRepository->fetchAll(10));
//        $this->showMock->shouldReceive('fetchAll')->with(1)->andReturn([
//
//        ]);

        $userRepository = App::make(App\Repositories\EloquentUserRepository::class, array($this->userMock));

        $this->assertEquals('foo', $userRepository->oneUser($this->userMock->id));
    }
}
