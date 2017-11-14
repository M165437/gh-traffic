<?php

namespace Tests\Unit\GitHub;

use Carbon\Carbon;

trait ApiGatewayContractTests
{
    abstract protected function getApiGateway();

    /** @test */
    function fetching_current_views_recives_14_or_15_latest_views()
    {
        $apiGateway = $this->getApiGateway();

        $currentViews = collect($apiGateway->fetchCurrentViews());

        $this->assertContains($currentViews->count(), [14, 15]);
        $this->assertTrue(Carbon::parse($currentViews->last()['timestamp'])->isToday());
    }
}