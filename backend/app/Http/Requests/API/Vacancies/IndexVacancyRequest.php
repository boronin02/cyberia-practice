<?php

namespace App\Http\Requests\API\Vacancies;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Pkg\WebApp\v1\Traits\RequestHasFilters;
use Pkg\WebApp\v1\Traits\RequestHasPagination;
use Pkg\WebApp\v1\Traits\RequestHasSorters;

class IndexVacancyRequest extends FormRequest
{
    use RequestHasFilters, RequestHasPagination, RequestHasSorters;

    public function rules(): iterable
    {
        return [];
    }

    public function filters(): iterable
    {
        return [
            'show_on_home' => function ($builder, $value) {
                return $builder->where('show_on_home', $value);
            },
        ];
    }

    public function sorters(): iterable
    {
        return [];
    }

    public function getModels(): Builder
    {
        return Vacancy::query();
    }
}
