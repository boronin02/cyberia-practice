<?php

namespace App\Models\Concerns;

use Illuminate\Support\Carbon;

/**
 * @see \App\Models\Contracts\PresentInSitemap
 */
trait PresentInSitemap
{
    public function getSitemapLastMod(): Carbon
    {
        return $this->updated_at;
    }

    public function getSitemapSlug(): string
    {
        return $this->slug;
    }
}
