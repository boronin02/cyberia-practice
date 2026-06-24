<?php

namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface HasTags
{
    public function tags(): MorphToMany;
}
