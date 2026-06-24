<?php

namespace App\Models;

use App\Enums\Media\MediaCollectionType;
use App\Observers\BannerObserver;
use App\Traits\Orderable;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read int $id
 *
 * @property string|null $title
 * @property string|null $description
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Media|null $desktopBanner
 * @property-read Media|null $mobileBanner
 *
 * @method static Builder<static>|self query()
 *
 * @mixin Eloquent
 */
#[ObservedBy(BannerObserver::class)]
final class Banner extends Model implements HasMedia
{
    use Concerns\ClearsResponseCache, HasFactory, InteractsWithMedia, Orderable;

    protected $table = 'banners';

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionType::BannerDesktop->value)
            ->singleFile();
        $this->addMediaCollection(MediaCollectionType::BannerDesktop->value)
            ->singleFile();
    }

    public function desktopBanner(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::BannerDesktop->value)
            ->one();
    }

    public function mobileBanner(): MorphOne
    {
        return $this
            ->media()
            ->where('collection_name', MediaCollectionType::BannerMobile->value)
            ->one();
    }
}
