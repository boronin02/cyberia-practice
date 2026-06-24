<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class PostRepository
{
    /**
     * @return Builder<Post>|Post
     */
    protected function baseQuery(): Builder
    {
        return Post::query()
            ->where('published_at', '<=', now());
    }

    public function forIndex(): Builder
    {
        return $this
            ->baseQuery()
            ->with([
                'authors',
                'authors.positions',
                'tagsOrdered',
            ]);
    }

    public function forShow(string $slug): Post
    {
        return $this
            ->baseQuery()
            ->with([
                'authors',
                'authors.positions',
                'tagsOrdered',
            ])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * @return Collection<Post>
     */
    public function listBlogsForSitemap(): Collection
    {
        return $this
            ->queryListForSitemap()
            ->isBlog()
            ->get();
    }

    /**
     * @return Collection<Post>
     */
    public function listNewsForSitemap(): Collection
    {
        return $this
            ->queryListForSitemap()
            ->isNews()
            ->get();
    }

    /**
     * @return Builder|Post
     */
    protected function queryListForSitemap(): Builder
    {
        return $this
            ->baseQuery()
            ->select([
                'id',
                'slug',
                'updated_at',
            ])
            ->orderBy('slug');
    }
}
