<?php

namespace App\Support\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

final class PaginationService
{
    public function paginate(
        Builder       $builder,
        PaginationDTO $pagination,
    ): Paginator {
        return $builder->paginate(
            perPage: $pagination->perPage,
            page: $pagination->page,
        );
    }
}
