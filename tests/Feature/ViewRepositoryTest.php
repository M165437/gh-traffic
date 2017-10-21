<?php

namespace Tests\Feature;

use App\View;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_view_the_repository()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertSee(config('gh-traffic.repository_owner'));
        $response->assertSee(config('gh-traffic.repository_name'));
    }

    /** @test */
    function view_receives_latest_15_repository_views()
    {
        $viewsAsc20 = collect(range(20, 0))->map(function($day) {
            return factory(\App\View::class)->create([
                'timestamp' => Carbon::now()->subDays($day)->setTime(0, 0, 0)->toDateTimeString()
            ]);
        });
        $viewsDesc15 = $viewsAsc20->reverse()->take(15);

        $response = $this->get('/');

        $this->assertCount(15, $response->data('views'));
        $response->data('views')->assertEquals($viewsDesc15);
    }
}
