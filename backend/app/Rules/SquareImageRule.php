<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

final class SquareImageRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            return;
        }

        $data = file_get_contents($value->getRealPath());
        if (!$data) {
            return;
        }

        $size = getimagesizefromstring($data);
        if ($size === false) {
            return;
        }

        if ($size[0] !== $size[1]) {
            $fail(__('rules/square-image-rule.invalid'));
        }
    }
}
