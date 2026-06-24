<?php

namespace App\Repositories\Interfaces;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

interface VacancyRepositoryInterface
{
    public function all(): ?Collection;

    public function getVacancy(int $vacancyId): ?Vacancy;
}
