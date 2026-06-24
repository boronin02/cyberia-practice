<?php

namespace App\Support\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Paginator $resource
 */
class PaginationResource extends JsonResource
{
    /** @var class-string<JsonResource> */
    protected string $collectionClass;

    public function __construct(
        Paginator $resource,
        string    $collectionClass,
    ) {
        parent::__construct($resource);
        $this->collectionClass = $collectionClass;
    }

    public function toArray(Request $request): array
    {
        return [
            'pagination' => PaginationMetaResource::make($this->resource),
            'items' => $this->collectionClass::collection($this->resource),
        ];
    }
}
