<?php

namespace Tests\Unit;

use App\Services\GitHubService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GitHubServiceTest extends TestCase
{
    /** @test */
    function can_get_current_views_from_github()
    {
        $gitHubService = new GitHubService();

        $views = $gitHubService->fetchCurrentViews();

        $this->assertNotNull($views);
        $this->assertTrue(Carbon::parse($views->first()->timestamp)->isToday());
    }
}