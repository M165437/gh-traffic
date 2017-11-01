<?php

namespace App\GitHub;

use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubApiGateway implements ApiGateway
{
    public function fetchCurrentViews()
    {
        $response = GitHub::repo()->traffic()->views(
            config('gh-traffic.repository_owner'),
            config('gh-traffic.repository_name')
        );

        return $response['views'];
    }
}