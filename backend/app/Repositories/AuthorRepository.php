<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository implements AuthorRepositoryInterface
{
    public static function forDictionary(): \Illuminate\Support\Collection
    {
        return Author::query()->get();
    }

    public function all(): Collection|Author|null
    {
        return Author::all();
    }

    public function getAuthor(string $authorId): Collection|Author|null
    {
        return Author::find($authorId);
    }
}
