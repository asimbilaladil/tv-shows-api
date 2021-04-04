<?php


namespace Tests\Unit\Repository;


use Tests\TestCase;
use Config;

class TVMazeRepositoryTest extends TestCase
{

    public function testFetchAll(){
        Config::set('auth.enable_verification', false);
    }
}
