<?php

namespace App\Http\Resources\Vacancies;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Vacancy $resource
 */
class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'name_segments' => $this->resource->name_segments,
            'terms' => $this->resource->terms,
            'link' => $this->resource->link,
        ];
    }
}
