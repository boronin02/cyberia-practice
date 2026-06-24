<?php

namespace App\Models;

use App\Observers\ProjectCategoryObserver;
use App\Traits\Orderable;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 *
 * @property string $name
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection<int, Project> $projects
 *
 * @method static Builder<static>|self query()
 *
 * @mixin Eloquent
 */
#[ObservedBy(ProjectCategoryObserver::class)]
final class ProjectCategory extends Model
{
    use Concerns\ClearsResponseCache, HasFactory, Orderable;

    protected $table = 'project_categories';

    protected $guarded = ['id'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'project_category_id', 'id');
    }
}
