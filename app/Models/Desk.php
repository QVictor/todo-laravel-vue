<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Desk
 *
 * @property int $id
 * @property string $name
 * @property int $completed
 * @property string|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Desk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\DeskFactory factory(...$parameters)
 */
class Desk extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'sort',
        'completed',
        'completed_at',
    ];

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    public static function maxSort() {
        return Desk::max('sort');
    }
}
