<?php

namespace App\Http\Controllers;

use App\Repository;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepositoryController extends Controller
{
    public function show()
    {
        $repository = new Repository();

        $views = View::current();

        return view('index', ['repository' => $repository, 'views' => $views]);
    }
}
