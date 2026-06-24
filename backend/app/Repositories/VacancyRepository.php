<?php

namespace App\Repositories;

use App\Models\Vacancy;
use App\Repositories\Interfaces\VacancyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class VacancyRepository implements VacancyRepositoryInterface
{
    public function all(): ?Collection
    {
        return Vacancy::all();
    }

    public function getVacancy(int $vacancyId): ?Vacancy
    {
        return Vacancy::find($vacancyId);
    }
}
