<?php

namespace App\Http\Requests\API\Projects;

use App\Models\Project;
use App\Support\Pagination\Paginateable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Pkg\WebApp\v1\Traits\RequestHasFilters;
use Pkg\WebApp\v1\Traits\RequestHasSorters;

final class IndexProjectRequest extends FormRequest
{
    use Paginateable, RequestHasFilters, RequestHasSorters;

    public function rules(): iterable
    {
        return $this->withPaginationRules([
            'project_category_id' => ['sometimes', 'integer', 'exists:project_categories,id'],
        ]);
    }

    public function filters(): iterable
    {
        return [
            'show_on_home' => function ($builder, $value) {
                return $builder->where('show_on_home', $value);
            },
            'project_category_id' => function ($builder, $value) {
                return $builder->where('project_category_id', $value);
            },
        ];
    }

    public function sorters(): iterable
    {
        return [
            'home_order' => function ($builder, $direction) {
                return $builder->orderBy('home_order', $direction);
            },
        ];
    }

    public function getModels(): Builder
    {
        return Project::query();
    }
}
