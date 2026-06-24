<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 *
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Author[] $authors
 *
 * @mixin Eloquent
 */
final class Position extends Model
{
    use Concerns\ClearsResponseCache, HasFactory;

    protected $table = 'positions';

    protected $guarded = ['id'];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
