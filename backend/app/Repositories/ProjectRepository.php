<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Expression;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function forIndex(): Builder
    {
        return Project::query()
            ->with([
                'image',
                'imageMobile',
                'videoCover',
            ]);
    }

    public function forShow(string $slug): Project
    {
        return Project::query()
            ->with([
                'image',
                'imageMobile',
                'videoCover',
            ])
            ->withCase()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function forRelated(Project $project): Builder
    {
        return Project::query()
            ->with([
                'image',
                'imageMobile',
                'videoCover',
            ])
            ->withCase()
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->orderBy(new Expression('RAND(DAY(CURDATE()))'));
    }

    /**
     * @return Collection<Project>
     */
    public function listForSitemap(): Collection
    {
        return Project::query()
            ->select([
                'id',
                'slug',
                'updated_at',
            ])
            ->withCase()
            ->orderBy('slug')
            ->get();
    }
}
