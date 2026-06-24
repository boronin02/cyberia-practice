<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Feedbacks\StoreFeedbackRequest;
use App\Http\Resources\Feedbacks\FeedbackResource;
use App\Services\Feedbacks\FeedbackService;
use Illuminate\Http\JsonResponse;
use Pkg\WebApp\v1\Helpers\Api;

class FeedbackController
{
    public function __construct(
        private FeedbackService $feedbackService
    ) {
    }

    public function store(StoreFeedbackRequest $request): JsonResponse
    {
        $newFeedback = $this->feedbackService->store($request->getData());

        if (!$newFeedback) {
            return Api::internalError(__('api.base.internal_error'));
        }

        return Api::success(
            __('api.base.success'),
            (new FeedbackResource($newFeedback))->toArray(request()));
    }
}
