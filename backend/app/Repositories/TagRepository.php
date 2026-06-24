<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Collection;

final class TagRepository
{
    public function getTags(): Collection
    {
        return Tag::query()
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->orderBy('name')
            ->get();
    }
}
