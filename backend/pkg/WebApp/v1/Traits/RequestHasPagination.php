<?php

namespace Pkg\WebApp\v1\Traits;

trait RequestHasPagination
{
    public function getPage(): ?string
    {
        return $this->query('page', 1);
    }

    public function getPerPage(): ?string
    {
        return $this->query('perPage', 10);
    }
}
