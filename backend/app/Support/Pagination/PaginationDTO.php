<?php

namespace App\Support\Pagination;

readonly class PaginationDTO
{
    public function __construct(
        public int $page,
        public int $perPage,
    ) {
    }
}
