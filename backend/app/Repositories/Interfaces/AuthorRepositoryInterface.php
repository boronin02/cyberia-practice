<?php

namespace App\Repositories\Interfaces;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

interface AuthorRepositoryInterface
{
    public function all(): Collection|Author|null;

    public function getAuthor(string $authorId): Collection|Author|null;
}
