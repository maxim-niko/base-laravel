<?php

namespace App\Providers;

use App\Listeners\ArticleCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $subscribe = [
        ArticleCreatedListener::class,
    ];

}
