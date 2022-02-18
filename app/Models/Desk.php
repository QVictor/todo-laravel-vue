<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

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

    public static function maxSort()
    {
        return self::max('sort');
    }

    public function sortTasks($orderBy): \Illuminate\Database\Eloquent\Collection
    {
        return $this->tasks()->orderBy('sort', $orderBy)->get();
    }

    public function sortedDesks()
    {
        $desks = self::select('*')->orderBy('sort')->get();
        foreach ($desks as $desk) {
            $desk['tasks'] = $desk->sortTasks('asc');
        }
        return $desks;
    }

    public function store(string $name)
    {
        return self::create([
            'name' => $name,
            'sort' => self::maxSort() + 1
        ]);
    }

    public function updateDesk(int $deskId, string $name, bool $completed, Carbon $completed_at)
    {

        $existingDesk = Desk::find($deskId);

        if ($existingDesk) {
            $existingDesk->fill([
                'name' => $name,
                'completed' => $completed,
                'completed_at' => $completed_at ? $completed_at->format('Y-m-d h:m:s') : null
            ]);
            $existingDesk->save();
        }
        return $existingDesk;
    }

    public function deleteIfExist(int $id)
    {
        return Desk::where('id', $id)->delete();
    }

    public function massUpdate($data)
    {
        $sorting = $this->preparationDataForMassUpdate($data);
        batch()->update((new Desk()), $sorting, 'id');
    }

    protected function preparationDataForMassUpdate($data)
    {
        $sort = json_decode($data);
        $res = [];
        foreach ($sort as $item) {
            $item = json_decode(json_encode($item), true);
            $res[] = $item;
        }
        return $res;
    }
}
