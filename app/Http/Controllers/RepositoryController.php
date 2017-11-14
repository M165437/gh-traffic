<?php

namespace App\Http\Controllers;

use App\Repository;
use App\Services\GitHubService;
use App\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepositoryController extends Controller
{
    public function show(Request $request, GitHubService $githubService)
    {
        $data = $request->validate([
            'start' => 'date_format:Y-m-d|required_with:end',
            'end' => 'date_format:Y-m-d|required_with:start',
        ]);

        if (empty($data)) {
            $githubService->saveCurrentViews();
        }

        $repository = new Repository();

        $start = Carbon::parse($data['start'] ?? '14 days ago')->setTime(0, 0, 0)->toDateTimeString();
        $end = Carbon::parse($data['end'] ?? 'today')->setTime(0, 0, 0)->toDateTimeString();
        $views = View::whereBetween('timestamp', [$start, $end])->get();

        $dateRange = [
            "startDate" => $views->first()->timestamp,
            "endDate" => $views->last()->timestamp,
            "minDate" => View::oldest('timestamp')->first()->timestamp,
            "maxDate" => View::latest('timestamp')->first()->timestamp
        ];

        return view('index', [
            'repository' => $repository,
            'views' => $views,
            'dateRange' => $dateRange
        ]);
    }
}
