<?php

namespace App\Repositories;

use App\Models\Feedback;
use App\Repositories\Interfaces\FeedbackRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    public function all(): Collection|Feedback|null
    {
        return Feedback::all();
    }

    public function getFeedback(int $feedbackId): Collection|Feedback|null
    {
        return Feedback::find($feedbackId);
    }
}
