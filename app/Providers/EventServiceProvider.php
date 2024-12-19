<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PostPublished;
use App\Listeners\NotifyPostPublished;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostPublished::class => [
            NotifyPostPublished::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
