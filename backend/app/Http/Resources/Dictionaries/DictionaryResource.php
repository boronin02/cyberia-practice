<?php

namespace App\Http\Resources\Dictionaries;

use App\Http\Resources\Author\AuthorDictionaryResource;
use App\Repositories\AuthorRepository;
use Closure;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property array $resource
 */
class DictionaryResource extends JsonResource
{
    public function toArray($request): array
    {
        $enums = $this->enums();
        $models = $this->models();

        return collect($this->resource)
            ->unique()
            ->mapWithKeys(function (string $name) use ($enums, $models) {

                $dictionary = null;

                if ($enums->has($name)) {
                    $dictionary = $enums->get($name);

                    if ($dictionary instanceof Closure) {
                        $dictionary = call_user_func($dictionary);
                    }

                } elseif ($models->has($name)) {
                    $dictionary = $models->get($name);

                    if ($dictionary instanceof Closure) {
                        $dictionary = call_user_func($dictionary);
                    }
                }

                return [
                    $name => $dictionary,
                ];
            })
            ->filter()
            ->toArray();
    }

    protected function enums(): Collection
    {
        return collect();
    }

    protected function models(): Collection
    {
        return collect([
            'authors' => fn() => AuthorDictionaryResource::collection(
                AuthorRepository::forDictionary()
            ),
        ]);
    }
}
