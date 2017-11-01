<?php

namespace Tests\Unit\GitHub;

use Carbon\Carbon;

trait ApiGatewayContractTests
{
    abstract protected function getApiGateway();

    /** @test */
    function fetching_views_is_successful()
    {
        $apiGateway = $this->getApiGateway();

        $currentViews = collect($apiGateway->fetchCurrentViews());

        $this->assertCount(14, $currentViews);
        $this->assertTrue(Carbon::parse($currentViews->last()['timestamp'])->isToday());
    }
}