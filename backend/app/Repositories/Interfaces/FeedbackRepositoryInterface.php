<?php

namespace App\Repositories\Interfaces;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;

interface FeedbackRepositoryInterface
{
    public function all(): Collection|Feedback|null;

    public function getFeedback(int $feedbackId): Collection|Feedback|null;
}
