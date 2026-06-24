<?php

namespace App\Services\Interfaces;

use App\DTO\Feedbacks\StoreFeedbackDTO;
use App\Models\Feedback;

interface FeedbackServiceInterface
{
    public function store(StoreFeedbackDTO $feedbackDTO): ?Feedback;

    public function destroy(string $feedbackId): bool;
}
