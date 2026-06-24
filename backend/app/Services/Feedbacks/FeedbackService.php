<?php

namespace App\Services\Feedbacks;

use App\DTO\Feedbacks\StoreFeedbackDTO;
use App\Models\Feedback;
use App\Services\Interfaces\FeedbackServiceInterface;

class FeedbackService implements FeedbackServiceInterface
{
    public function store(StoreFeedbackDTO $feedbackDTO): ?Feedback
    {
        $newFeedback = Feedback::create($feedbackDTO->toArray());

        if (!$newFeedback) {
            return null;
        }

        return $newFeedback;
    }

    public function destroy(string $feedbackId): bool
    {
        return Feedback::destroy($feedbackId);
    }
}
