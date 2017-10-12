<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function show()
    {
        $repository = (object) [
            'owner' => config('gh-traffic.repository_owner'),
            'name' => config('gh-traffic.repository_name'),
        ];

        return view('index', ['repository' => $repository]);
    }
}
