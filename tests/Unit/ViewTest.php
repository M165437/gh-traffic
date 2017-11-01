<?php

namespace Tests\Unit;

use App\View;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use RefreshDatabase;

    private function timestampDaysAgo($days = 0)
    {
        return Carbon::now()->subDays($days)->setTime(0, 0, 0)->toDateTimeString();
    }

    /** @test */
    function can_get_latest_views_ordered_by_timestamp()
    {
        $viewA = factory(View::class)->create(['timestamp' => $this->timestampDaysAgo(1)]);
        $viewC = factory(View::class)->create(['timestamp' => $this->timestampDaysAgo(3)]);
        $viewB = factory(View::class)->create(['timestamp' => $this->timestampDaysAgo(2)]);
        $orderedViews = collect([$viewA, $viewB, $viewC]);

        $latestViews = View::latest()->take(3)->get();

        $this->assertEquals($orderedViews->toArray(), $latestViews->toArray());
    }

    /** @test */
    function can_get_current_views_from_GitHub_if_not_available()
    {
        $views = View::current();
        $this->assertTrue(Carbon::parse($views->last()->timestamp)->isToday());
    }
}