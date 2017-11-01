<?php

namespace App\GitHub;

use Carbon\Carbon;

class FakeApiGateway implements ApiGateway
{
    public function fetchCurrentViews()
    {
        return collect(range(13, 0))->map(function($daysAgo) {
            $count = rand(5, 50);

            return [
                'timestamp' => Carbon::today()->subDays($daysAgo)->toIso8601String(),
                'count' => $count,
                'uniques' => rand($count, 75)
            ];
        })->all();
    }
}