<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Collection;

final class BannerRepository
{
    public function getBanners(): Collection
    {
        return Banner::query()
            ->with([
                'desktopBanner',
                'mobileBanner',
            ])
            ->get();
    }
}
