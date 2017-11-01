<?php

namespace Tests\Unit\GitHub;

use App\GitHub\FakeApiGateway;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FakeApiGatewayTest extends TestCase
{
    use ApiGatewayContractTests;

    protected function getApiGateway()
    {
        return new FakeApiGateway;
    }
}