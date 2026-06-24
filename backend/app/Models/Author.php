<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @property-read int $id
 *
 * @property string $last_name
 * @property string $first_name
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string $full_name
 * @property-read string|null $image_url
 * @property-read Collection<Position> $positions
 * @property-read Collection<Post> $posts
 *
 * @mixin Eloquent
 */
final class Author extends Model
{
    use Concerns\ClearsResponseCache, HasFactory, SoftDeletes;

    protected $table = 'authors';

    protected $guarded = ['id'];

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::get(function (): string {
            return "{$this->first_name} {$this->last_name}";
        });
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->image != ''
                ? asset(Storage::url($this->image))
                : null,
        );
    }
}
