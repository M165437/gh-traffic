<?php

namespace Tests\Unit\GitHub;

use App\GitHub\GitHubApiGateway;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group integration
 */
class GitHubApiGatewayTest extends TestCase
{
    use ApiGatewayContractTests;

    protected function getApiGateway()
    {
        return new GitHubApiGateway;
    }
}