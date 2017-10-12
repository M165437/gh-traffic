<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewRepositoryTest extends TestCase
{
    /** @test */
    function user_can_view_the_configured_repository_details()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertSee(config('gh-traffic.repository_owner'));
        $response->assertSee(config('gh-traffic.repository_name'));
    }
}
