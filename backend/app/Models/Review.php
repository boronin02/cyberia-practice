<?php

namespace App\Models;

use App\Enums\Media\MediaCollectionType;
use App\Traits\Orderable;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read int $id
 *
 * @property int $project_id
 * @property string $content
 * @property int $order
 * @property string $fio
 * @property string|null $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Project $project
 *
 * @method static Builder<static>|self query()
 *
 * @mixin Eloquent
 */
final class Review extends Model implements HasMedia
{
    use Concerns\ClearsResponseCache, HasFactory, InteractsWithMedia, Orderable;

    protected $table = 'reviews';

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionType::ReviewDocument->value)
            ->useDisk('review-documents')
            ->singleFile();

        $this->addMediaCollection(MediaCollectionType::ReviewImage->value)
            ->useDisk('review-documents')
            ->singleFile();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getReviewDocument(): ?Media
    {
        if ($this->relationLoaded('media')) {
            return $this->getFirstMedia(MediaCollectionType::ReviewDocument->value);
        }

        return null;
    }

    public function getReviewImage(): ?Media
    {
        if ($this->relationLoaded('media')) {
            return $this->getFirstMedia(MediaCollectionType::ReviewImage->value);
        }

        return null;
    }

    public static function relations(): array
    {
        return ['project'];
    }
}
