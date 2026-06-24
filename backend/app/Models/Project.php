<?php

namespace App\Models;

use App\Enums\Media\MediaCollectionType;
use App\Services\ContentBuilder\ContentService;
use App\Traits\Orderable;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property-read int $id
 *
 * @property string $slug
 * @property string $title
 * @property int|null $project_category_id
 * @property string $description
 * @property int $price
 * @property string $time
 * @property string $link
 * @property array|null $content
 * @property bool $is_big
 * @property bool $show_on_home
 * @property int $order
 * @property int $home_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property-read ProjectCategory|null $projectCategory
 * @property-read Media|null $image
 * @property-read Media|null $imageMobile
 * @property-read Media|null $videoCover
 * @property-read array $formatted_content
 * @property-read bool $is_case
 *
 * @method static Builder<static>|self query()
 * @method static Builder<static>|self withCase(bool $isWithCase = true)
 *
 * @mixin Eloquent
 */
final class Project extends Model implements Contracts\PresentInSitemap, HasMedia
{
    use Concerns\ClearsResponseCache,
        Concerns\PresentInSitemap,
        HasFactory,
        HasSlug,
        InteractsWithMedia,
        Orderable,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'content' => 'array',
        'is_big' => 'boolean',
        'show_on_home' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionType::ProjectImage->value)
            ->useDisk('projects')
            ->singleFile();
        $this->addMediaCollection(MediaCollectionType::ProjectImageMobile->value)
            ->useDisk('projects')
            ->singleFile();
        $this->addMediaCollection(MediaCollectionType::ProjectVideoCover->value)
            ->useDisk('projects')
            ->acceptsMimeTypes(MediaCollectionType::ProjectVideoCover->allowedMimeTypes())
            ->singleFile();

        $this->addMediaConversion('thumb')
            ->height(100);
    }

    public function projectCategory(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id', 'id');
    }

    public function image(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::ProjectImage->value)
            ->one();
    }

    public function imageMobile(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::ProjectImageMobile->value)
            ->one();
    }

    public function videoCover(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::ProjectVideoCover->value)
            ->one();
    }

    protected function formattedContent(): Attribute
    {
        return Attribute::make(
            get: fn($value): array => (new ContentService)->format($this->content)
        );
    }

    protected function isCase(): Attribute
    {
        return Attribute::get(function (): bool {
            return filled($this->content);
        });
    }

    public function scopeWithCase(Builder $builder, bool $isWithCase = true): Builder
    {
        if ($isWithCase) {
            return $builder
                ->whereNotNull('content')
                ->whereJsonLength('content', '>', 0);
        }

        return $builder->where(function (Builder $query) {
            $query->whereNull('content')
                ->orWhereJsonLength('content', '=', 0);
        });
    }

    public function awards(): HasMany
    {
        return $this->hasMany(Award::class, 'project_id', 'id');
    }

    public static function relations(): array
    {
        return ['projectCategory'];
    }
}
