<?php

namespace App\DTO\Feedbacks;

use Illuminate\Contracts\Support\Arrayable;

readonly class StoreFeedbackDTO implements Arrayable
{
    public function __construct(
        public ?string $name,
        public ?string $phone,
        public ?string $comment,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'comment' => $this->comment,
        ];
    }
}
