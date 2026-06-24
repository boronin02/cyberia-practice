<?php

namespace App\Models;

use App\Observers\VacancyObserver;
use App\Traits\Orderable;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 *
 * @property string $name_first
 * @property string $name_second
 * @property string $name_third
 * @property string $link
 * @property bool $show_on_home
 * @property array $terms
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property-read string $name
 * @property-read array $name_segments
 *
 * @method static Builder<static>|self query()
 *
 * @mixin Eloquent
 */
#[ObservedBy(VacancyObserver::class)]
final class Vacancy extends Model
{
    use Concerns\ClearsResponseCache, HasFactory, Orderable, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'terms' => 'array',
    ];

    protected function name(): Attribute
    {
        return Attribute::get(function (): string {
            return trim("{$this->name_first} {$this->name_second} {$this->name_third}");
        });
    }

    /** @noinspection PhpUnused */
    protected function nameSegments(): Attribute
    {
        return Attribute::get(function (): array {
            return array_filter([
                $this->name_first,
                $this->name_second,
                $this->name_third,
            ], 'strlen');
        });
    }
}
