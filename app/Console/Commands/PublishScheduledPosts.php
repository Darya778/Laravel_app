<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Events\PostPublished;

class PublishScheduledPosts extends Command
{
//    protected $signature = 'app:publish-scheduled-posts';
//    protected $description = 'Command description';
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Automatically publish posts scheduled for publishing';


    public function handle()
    {
        $posts = Post::where('is_published', false)
                     ->where('published_at', '<=', now())
                     ->get();

        foreach ($posts as $post) {
            $post->is_published = true;
            $post->save();
	    event(new PostPublished($post));
            $this->info("Post '{$post->title}' published.");
        }

        return Command::SUCCESS;
    }
}
