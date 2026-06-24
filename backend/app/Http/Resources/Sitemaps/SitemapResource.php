<?php

namespace App\Http\Resources\Sitemaps;

use App\Models\Contracts\PresentInSitemap;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property PresentInSitemap $resource
 */
final class SitemapResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /**
             * @var string
             *
             * @example some-slug
             */
            'slug' => $this->resource->getSitemapSlug(),

            /**
             * @var int
             *
             * @example 1769420759
             */
            'lastmod' => $this->resource->getSitemapLastMod()->timestamp,
        ];
    }
}
