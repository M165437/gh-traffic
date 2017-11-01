<?php

namespace Tests\Unit;

use App\GitHub\FakeApiGateway;
use App\GitHub\ApiGateway;
use App\Services\GitHubService;
use App\View;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GitHubServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function persists_current_views_from_github()
    {
        $fakeApiGateway = new FakeApiGateway();
        $this->app->instance(ApiGateway::class, $fakeApiGateway);

        $gitHubService = $this->app->make('App\Services\GitHubService');

        $viewsBefore = View::latest()->take(3)->get();
        $this->assertTrue($viewsBefore->isEmpty());

        $gitHubService->saveCurrentViews();

        $viewsAfter = View::latest()->take(3)->get();
        $this->assertFalse($viewsAfter->isEmpty());
        $this->assertTrue(Carbon::parse($viewsAfter->first()->timestamp)->isToday());
    }
}