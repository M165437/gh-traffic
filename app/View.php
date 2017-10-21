<?php

namespace App;

use App\Services\GitHubService;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'timestamp';

    public $incrementing = false;
    public $timestamps = false;

    public static function latest($column = 'timestamp')
    {
        return self::orderBy($column, 'desc');
    }

    public static function current()
    {
        $views = self::latest()->take(15)->get();

        if (! $views || ! $views->first()->isToday()) {
            $views = (new GitHubService())->fetchCurrentViews();
            return $views->each->save();
        }

        return $views;
    }

    public function isToday()
    {
        return Carbon::parse($this->timestamp)->isToday();
    }
}
