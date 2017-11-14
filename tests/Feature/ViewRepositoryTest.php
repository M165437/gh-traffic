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
    function view_without_daterange_receives_latest_15_repository_views()
    {
        $views = collect(range(20, 0))->map(function($day) {
            return factory(\App\View::class)->create([
                'timestamp' => Carbon::today()->subDays($day)->toDateTimeString()
            ]);
        });

        $response = $this->get('/');

        $response->data('views')->assertEquals($views->take(-15));
    }

    /** @test */
    function view_with_daterange_receives_requested_repository_views()
    {
        $views = collect(range(20, 0))->map(function($day) {
            return factory(\App\View::class)->create([
                'timestamp' => Carbon::today()->subDays($day)->toDateTimeString()
            ]);
        });

        $start = Carbon::today()->subDays(10);
        $end = Carbon::today()->subDays(5);

        $response = $this->get('/?start=' . $start->toDateString() . '&end=' . $end->toDateString());

        $this->assertCount(6, $response->data('views'));
        $this->assertEquals($start->toDateTimeString(), $response->data('views')->first()->timestamp);
        $this->assertEquals($end->toDateTimeString(), $response->data('views')->last()->timestamp);
    }
}
