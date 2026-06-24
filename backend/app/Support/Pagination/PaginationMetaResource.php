<?php

namespace App\Support\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property-read Paginator $resource
 */
class PaginationMetaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'page' => $this->resource->currentPage(),
            'per_page' => $this->resource->perPage(),
            $this->mergeWhen(
                $this->resource instanceof LengthAwarePaginator,
                function () {
                    /** @var LengthAwarePaginator $resource */
                    $resource = $this->resource;

                    return [
                        'last_page' => $resource->lastPage(),
                        'total' => $resource->total(),
                    ];
                }
            ),
        ];
    }
}
