<?php

namespace App\Models\Concerns;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property Collection<Tag> $tags
 * @property Collection<Tag> $tagsOrdered
 */
trait HasTags
{
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(
                Tag::class,
                'taggable',
                'taggables'
            )
            ->withTimestamps();
    }

    public function tagsOrdered(): MorphToMany
    {
        return $this
            ->morphToMany(
                Tag::class,
                'taggable',
                'taggables'
            )
            ->withTimestamps()
            ->orderByPivot('id');
    }
}
