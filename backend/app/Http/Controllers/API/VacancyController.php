<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Vacancies\IndexVacancyRequest;
use App\Http\Resources\Vacancies\VacancyResource;
use App\Repositories\VacancyRepository;
use Illuminate\Http\JsonResponse;
use Pkg\WebApp\v1\Helpers\Api;
use Pkg\WebApp\v1\Helpers\Paginated;

class VacancyController extends Controller
{
    public function __construct(
        private VacancyRepository $vacancyRepository
    ) {
    }

    public function index(IndexVacancyRequest $request): JsonResponse
    {
        $vacancy = $this->vacancyRepository->all();

        if (!$vacancy) {
            return Api::notFound(__('api.base.not_found'));
        }

        return Api::success(
            __('api.base.success'),
            Paginated::paginate(
                $request->getPage(),
                $request->getPerPage(),
                $request->filter(
                    $request->sort(
                        $request->getModels()
                    )
                ),
                VacancyResource::class,
            ),
        );
    }
}
