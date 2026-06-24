<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read bool|null $posts_exists
 * @property-read int|null $posts_count
 *
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 *
 * @mixin Eloquent
 */
final class Tag extends Model
{
    use Concerns\ClearsResponseCache, HasFactory;

    protected $guarded = ['id'];

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(
            Post::class,
            'taggable',
            'taggables',
            'tag_id',
            'taggable_id'
        );
    }
}
