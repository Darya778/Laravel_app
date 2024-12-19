<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostPublished;
use Illuminate\Support\Facades\Log;

class NotifyPostPublished
{
    public function __construct()
    {
        //
    }

    public function handle(PostPublished $event)
    {
        // Логирование заголовка опубликованного поста
        Log::info("Post '{$event->post->title}' has been published.");
    }
}
