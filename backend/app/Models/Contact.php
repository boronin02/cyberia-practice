<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 *
 * @property string $key
 * @property string|null $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|self query()
 *
 * @mixin Eloquent
 */
final class Contact extends Model
{
    use Concerns\ClearsResponseCache;

    protected $table = 'contacts';

    protected $guarded = ['id'];
}
