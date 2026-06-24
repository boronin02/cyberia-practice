<?php

namespace App\Http\Requests\API\Projects;

use App\Support\Pagination\Paginateable;
use Illuminate\Foundation\Http\FormRequest;

final class RelatedProjectRequest extends FormRequest
{
    use Paginateable;

    public function rules(): iterable
    {
        return $this->withPaginationRules([

        ]);
    }
}
