<?php

namespace Tests\Unit;

use App\Repository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function has_configured_owner_and_name()
    {
        config(['gh-traffic.repository_owner' => 'John']);
        config(['gh-traffic.repository_name' => 'Example']);

        $repository = new Repository();

        $this->assertEquals('John', $repository->owner);
        $this->assertEquals('Example', $repository->name);
    }
}