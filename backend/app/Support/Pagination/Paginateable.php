<?php

namespace App\Support\Pagination;

trait Paginateable
{
    public function getPagination(): PaginationDTO
    {
        return new PaginationDTO(
            $this->input('page', $this->getDefaultPage()),
            $this->input('per_page', $this->getDefaultPerPage()),
        );
    }

    protected function withPaginationRules(array $rules): array
    {
        return array_merge($rules, [
            'per_page' => ['integer'],
            'page' => ['integer'],
        ]);
    }

    protected function getDefaultPage(): int
    {
        return 1;
    }

    protected function getDefaultPerPage(): int
    {
        return 10;
    }
}
