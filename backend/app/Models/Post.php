<?php

namespace App\Models;

use App\Models\Concerns\HasTags;
use App\Observers\PostObserver;
use App\Services\ContentBuilder\ContentService;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property-read int $id
 *
 * @property string $title
 * @property string|null $description
 * @property string $slug
 * @property string $image
 * @property string $image_preview
 * @property array $content
 * @property bool $is_published
 * @property bool $is_news
 * @property bool $is_popular
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property-read string $image_url
 * @property-read string $image_preview_url
 * @property-read array $formatted_content
 * @property-read Collection<Post> $related_posts
 * @property-read Collection<Author> $authors
 *
 * @method static Builder<static>|self query()
 *
 * @mixin Eloquent
 */
#[ObservedBy(PostObserver::class)]
final class Post extends Model implements Contracts\HasTags, Contracts\PresentInSitemap
{
    use Concerns\ClearsResponseCache,
        Concerns\PresentInSitemap,
        HasFactory,
        HasSlug,
        HasTags,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'bool',
        'content' => 'array',
        'published_at' => 'datetime',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /** @noinspection PhpUnused */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->image != ''
                ? asset(Storage::url($this->image))
                : null,
        );
    }

    /** @noinspection PhpUnused */
    protected function imagePreviewUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->image_preview != ''
                ? asset(Storage::url($this->image_preview))
                : null,
        );
    }

    /** @noinspection PhpUnused */
    protected function formattedContent(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (new ContentService)->format($this->content)
        );
    }

    // todo вынести в репозиторий

    /** @noinspection PhpUnused */
    protected function relatedPosts(): Attribute
    {
        return Attribute::make(
            get: fn($value): Collection => Post::query()
                ->with(['authors'])
                ->where('id', '!=', $this->id)
                ->where('is_published', true)
                ->where('is_news', $this->is_news)
                ->orderBy('published_at', 'desc')
                ->limit(6)
                ->get()
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** @noinspection PhpUnused */
    public function scopeIsNews(Builder $query): void
    {
        $query->where('is_news', true);
    }

    /** @noinspection PhpUnused */
    public function scopeIsBlog(Builder $query): void
    {
        $query->where('is_news', false);
    }

    public static function relations(): array
    {
        return ['authors', 'tags'];
    }
}
