<?php

namespace App\Http\Requests;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Pkg\WebApp\v1\Traits\RequestHasPagination;

class IndexReviewRequest extends FormRequest
{
    use RequestHasPagination;

    public function rules(): array
    {
        return [];
    }

    public function getModels(): Builder
    {
        return Review::query()->with(['media', 'project']);
    }
}
