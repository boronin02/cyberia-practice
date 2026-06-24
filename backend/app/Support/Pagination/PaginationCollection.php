<?php

namespace App\Support\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @property-read Paginator $resource
 */
abstract class PaginationCollection extends ResourceCollection
{
    /** @var class-string<JsonResource> */
    protected string $collectionClass;

    public function __construct($resource, $collectionClass)
    {
        parent::__construct($resource);

        $this->collectionClass = $collectionClass;
    }

    public function toArray(Request $request): array
    {
        $collectionValue = $this->collectionClass::collection(
            $this->resource->items()
        );

        return [
            'pagination' => PaginationMetaResource::make($this->resource),
            $this->getCollectionKey() => $collectionValue,
        ];
    }

    abstract protected function getCollectionKey(): string;
}
