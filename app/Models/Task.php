<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $name
 * @property string|null $desk_id
 * @property int $completed
 * @property string|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desk|null $desk
 * @method static \Database\Factories\TaskFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desk_id',
        'sort',
    ];

    public function desk(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Desk::class);
    }

    public static function maxSort()
    {
        return Task::max('sort');
    }

    public function sortedTasks()
    {
        return Task::all()->groupBy('desk_id');
    }

    public function store(string $name, int $deskId) {
        return self::create([
            'name' => $name,
            'sort' => Task::maxSort() + 1,
            'desk_id' => $deskId
        ]);
    }

    public function updateItem(int $deskId, string $name, int $sort, bool $completed, Carbon | null $completed_at)
    {
        $item = Task::find($deskId);
        if ($item) {
            $item->fill([
                'name' => $name,
                'sort' => $sort,
                'completed' => $completed,
                'completed_at' => $completed_at ? $completed_at->format('Y-m-d h:i:s') : null
            ]);
            $item->save();
        }
        return $item;
    }


    public function deleteIfExist(int $id)
    {
        return Task::where('id', $id)->delete();
    }
}
