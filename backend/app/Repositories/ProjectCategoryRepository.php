<?php

namespace App\Repositories;

use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Collection;

final class ProjectCategoryRepository
{
    public function getProjectCategories(): Collection
    {
        return ProjectCategory::all();
    }
}
