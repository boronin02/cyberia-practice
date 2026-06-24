<?php

namespace App\Models\Contracts;

use Illuminate\Support\Carbon;

/**
 * @see \App\Models\Concerns\PresentInSitemap
 */
interface PresentInSitemap
{
    public function getSitemapLastMod(): Carbon;

    public function getSitemapSlug(): string;
}
