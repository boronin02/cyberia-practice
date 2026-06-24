<?php

namespace App\Http\Requests\API\Dictionaries;

use Illuminate\Foundation\Http\FormRequest;

class DictionaryRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getDictionaries(): array
    {
        return explode(',', $this->input('by_name', ''));
    }
}
