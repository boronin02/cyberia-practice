<?php

namespace App\Models;

use App\Events\FeedbackCreated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 *
 * @property string $name
 * @property string $phone
 * @property string $comment
 *
 * @mixin Eloquent
 */
final class Feedback extends Model
{
    protected $guarded = ['id'];

    protected $dispatchesEvents = [
        'created' => FeedbackCreated::class,
    ];
}
