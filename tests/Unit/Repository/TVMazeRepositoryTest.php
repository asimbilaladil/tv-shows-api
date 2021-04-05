<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;


use App\Models\Show;
use App\Repository\TVMazeRepository;
use App\Services\HttpService;
use Illuminate\Support\Facades\Config;
use Mockery;
use Tests\TestCase;

class TVMazeRepositoryTest extends TestCase
{
    private $httpService;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->httpService = Mockery::mock(HttpService::class);

        Config::set('shows.shows', 'shows');
        Config::set('shows.search_shows', 'search');
    }

    public function testFetchAllAndFindByName(): void
    {
        $data = $this->getTestData();

        $this->httpService
            ->shouldReceive('getData')
            ->andReturn(
                [
                    'data' => $data,
                    'status' => true
                ]
            );

        $tvMazeRepository = new TVMazeRepository($this->httpService);

        $result = $tvMazeRepository->fetchAll(10);

        $this->assertCount(1, $result['data'], 'testFetchAll');

        $result = $tvMazeRepository->findByName($data[0]['name']);

        $this->assertTrue(count($result['data']) > 0, 'testFindByName');
    }

    private function getTestData(): array
    {
        $show = Show::factory()->make();
        return [
            [
                'name' => $show['name'],
                'image' => [
                    'medium' => $show['image']
                ],
                'link' => $show['link'],
                'show_id' => $show['show_id'],
                'status' => $show['status'],
            ]
        ];
    }

}
