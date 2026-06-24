<?php

namespace App\Enums\Media;

use Exception;

enum MediaCollectionType: string
{
    case ReviewImage = 'review_image';

    case ReviewDocument = 'document';

    case BannerDesktop = 'banner_desktop';

    case BannerMobile = 'banner_mobile';

    case AwardImage = 'award_image';

    case AwardIcon = 'award_icon';

    case ProjectImage = 'image';

    case ProjectImageMobile = 'image_mobile';
    case ProjectVideoCover = 'project_video_cover';

    public function allowedMimeTypes(): array
    {
        return match ($this) {
            self::ProjectVideoCover => [
                'video/mp4',
                'video/webm',
            ],
            default => throw new Exception("Not implement for {$this->value}")
        };
    }
}
