<?php

namespace App\Models;

use App\Enums\Media\MediaCollectionType;
use App\Observers\AwardObserver;
use App\Traits\Orderable;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $project_id
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read Project|null $project
 * @property-read Media|null $awardImage
 * @property-read Media|null $awardIcon
 *
 * @mixin Eloquent
 */
#[ObservedBy(AwardObserver::class)]
final class Award extends Model implements HasMedia
{
    use Concerns\ClearsResponseCache, HasFactory, InteractsWithMedia, Orderable;

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionType::AwardImage->value)
            ->singleFile();
        $this->addMediaCollection(MediaCollectionType::AwardIcon->value)
            ->singleFile();
    }

    public function awardImage(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::AwardImage->value)
            ->one();
    }

    public function awardIcon(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::AwardIcon->value)
            ->one();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public static function relations(): array
    {
        return ['project'];
    }
}
