<?php


namespace Tests\Feature\Controllers;


use App\Models\Show;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_all_shows()
    {
        $show = Show::factory()->create();
        $data =     [
            "data" =>  [
            "current_page" => 1,
            "data" =>[ [
                'name'      => $show['name'],
                'link'      => $show['link'],
                'image'     => $show['image'],
                'show_id'   => $show['show_id'],
            ]],
            "first_page_url" => "http://localhost/api/shows?page=1",
            "from" => 1,
            "last_page" => 1,
            "last_page_url" => "http://localhost/api/shows?page=1",
            "links" => [
                [
                    "url" => null,
                    "label" => "&laquo; Previous",
                    "active" => false
                ], [
                    "url" => "http://localhost/api/shows?page=1",
                    "label" => "1",
                    "active" => true
                ],
                [
                    "url" => null,
                    "label" => "Next &raquo;",
                    "active" => false
                ]
            ],
            "next_page_url" => null,
            "path" => "http://localhost/api/shows",
            "per_page" => 10,
            "prev_page_url" => null,
            "to" => 1,
            "total" => 1,
        ],
            "status" => 201];
        $response= $this->get('/api/shows')
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function test_it_returns_search_show()
    {
        $show = Show::factory()->create();
        $data =     [
            "data" =>  [
                "current_page" => 1,
                "data" =>[ [
                    'name'      => $show['name'],
                    'link'      => $show['link'],
                    'image'     => $show['image'],
                    'show_id'   => $show['show_id'],
                ]],
                "first_page_url" => "http://localhost/api/show/search?page=1",
                "from" => 1,
                "last_page" => 1,
                "last_page_url" => "http://localhost/api/show/search?page=1",
                "links" => [
                    [
                        "url" => null,
                        "label" => "&laquo; Previous",
                        "active" => false
                    ], [
                        "url" => "http://localhost/api/show/search?page=1",
                        "label" => "1",
                        "active" => true
                    ],
                    [
                        "url" => null,
                        "label" => "Next &raquo;",
                        "active" => false
                    ]
                ],
                "next_page_url" => null,
                "path" => "http://localhost/api/show/search",
                "per_page" => 10,
                "prev_page_url" => null,
                "to" => 1,
                "total" => 1,
            ],
            "status" => 201];
        $response= $this->get('/api/show/search?q='.$show['name'])
            ->assertStatus(201)
            ->assertJson($data);
    }

}
