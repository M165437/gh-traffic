<?php

namespace App;

use App\View;

class Repository
{
    public $owner;
    public $name;

    public function __construct()
    {
        $this->owner = config('gh-traffic.repository_owner');
        $this->name = config('gh-traffic.repository_name');
    }
}