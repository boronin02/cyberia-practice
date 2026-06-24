<?php

namespace App\Mail;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewFeedback extends Mailable
{
    use Queueable, SerializesModels;

    public $locale = 'ru';

    public function __construct(
        public Feedback $feedback,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('filament/feedback.created_new'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.feedback.new',
        );
    }
}
