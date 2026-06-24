<?php

namespace App\Http\Requests\API\Feedbacks;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Pkg\WebApp\v1\Traits\RequestHasFilters;
use Pkg\WebApp\v1\Traits\RequestHasPagination;
use Pkg\WebApp\v1\Traits\RequestHasSorters;

class IndexFeedbackRequest extends FormRequest
{
    use RequestHasFilters, RequestHasPagination, RequestHasSorters;

    public function rules(): iterable
    {
        return [];
    }

    public function filters(): iterable
    {
        return [];
    }

    public function sorters(): iterable
    {
        return [];
    }

    public function getModels(): Builder
    {
        return Feedback::query();
    }
}
