<?php

namespace App\Observers;

use App\Models\Post;
use Carbon\Carbon;

final class PostObserver
{
    public function saving(Post $post): void
    {
        if ($post->is_published && is_null($post->published_at)) {
            $post->published_at = Carbon::now();
        } elseif (!$post->is_published) {
            $post->published_at = null;
        }
    }
}
