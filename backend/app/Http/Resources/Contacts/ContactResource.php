<?php

namespace App\Http\Resources\Contacts;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Contact $resource
 */
final class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $resource = $this->resource;

        return [
            'kay' => $resource->key,
            'value' => $resource->value,
        ];
    }
}
