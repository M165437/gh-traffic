<?php

namespace App\Services;

use App\GitHub\ApiGateway;
use App\View;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubService
{
    private $apiGateway;

    public function __construct(ApiGateway $apiGateway)
    {
        $this->apiGateway = $apiGateway;
    }

    public function saveCurrentViews()
    {
        $currentViews = $this->apiGateway->fetchCurrentViews();

        return collect($currentViews)->map(function($view) {
            return View::updateOrCreate(
                [ 'timestamp' => Carbon::parse($view['timestamp'])->toDateTimeString() ],
                [ 'count' => $view['count'], 'uniques' => $view['uniques'] ]
            );
        });
    }
}