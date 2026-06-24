<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepositoryInterface
{
    public function all(): Collection|Contact|null;
}
