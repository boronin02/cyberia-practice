<?php

namespace App\Listeners;

use App\Events\FeedbackCreated;
use App\Mail\NewFeedback;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendFeedbackNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(FeedbackCreated $event): void
    {
        Mail::to(config('mail.feedback.target_email'))->send(new NewFeedback($event->feedback));
    }
}
