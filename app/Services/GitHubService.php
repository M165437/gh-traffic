<?php

namespace App\Services;

use App\View;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubService
{
    public function fetchCurrentViews()
    {
        $response = GitHub::repo()->traffic()->views(
            config('gh-traffic.repository_owner'),
            config('gh-traffic.repository_name')
        );

        $views = collect($response['views'])->reverse()->map(function($view) {
            return View::make([
                'timestamp' => Carbon::parse($view['timestamp'])->toDateTimeString(),
                'count' => $view['count'],
                'uniques' => $view['uniques']
            ]);
        });

        return $views;
    }
}