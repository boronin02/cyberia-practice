<?php

namespace App\Http\Requests\API\Feedbacks;

use App\DTO\Feedbacks\StoreFeedbackDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'phone' => ['string', 'required', 'max:255'],
            'comment' => ['string', 'nullable', 'max:65535'],
        ];
    }

    public function getData(): StoreFeedbackDTO
    {
        return new StoreFeedbackDTO(
            $this->validated('name'),
            $this->validated('phone'),
            $this->validated('comment'),
        );
    }
}
