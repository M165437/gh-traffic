<?php

namespace Tests\Unit;

use App\Services\GitHubService;
use App\View;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GitHubServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_and_persist_current_views_from_github()
    {
        $gitHubService = new GitHubService();

        $gitHubService->fetchCurrentViews();
        $views = View::latest()->take(3)->get();

        $this->assertNotNull($views);
        $this->assertTrue(Carbon::parse($views->first()->timestamp)->isToday());
    }
}