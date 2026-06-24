<?php

namespace App\Repositories;

use App\Models\Award;
use Illuminate\Database\Eloquent\Collection;

final class AwardRepository
{
    public function getAwards(): Collection
    {
        return Award::query()
            ->with([
                'project',
                'project.image',
                'project.imageMobile',
                'project.videoCover',
                'awardImage',
                'awardIcon',
            ])
            ->get();
    }

    public function getAwardsByProjectId(int $projectId): Collection
    {
        return Award::query()
            ->with([
                'awardImage',
                'awardIcon',
            ])
            ->where('project_id', $projectId)
            ->get();
    }
}
