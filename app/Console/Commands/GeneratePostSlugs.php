<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Post;

#[Signature('app:generate-post-slugs')]
#[Description('Command description')]
class GeneratePostSlugs extends Command
{
    /**
     * Execute the console command.
     */
public function handle()
{
    $posts = Post::whereNull('slug')->get();

    foreach ($posts as $post) {

        $post->slug = Post::generateSlug($post->title);

        $post->save();

        $this->info("Slug created for: {$post->title}");
    }

    $this->info('All missing slugs generated successfully!');
}
}
