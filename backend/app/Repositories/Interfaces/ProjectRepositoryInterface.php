<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

interface ProjectRepositoryInterface
{
    public function forIndex(): Builder;

    public function forShow(string $slug): Project;

    public function forRelated(Project $project): Builder;
}
