<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\massUpdateService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Response;

class TaskController extends Controller
{
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection|Task[]
     */
    public function index()
    {
        return $this->task->sortedTasks();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $newTask = $this->task->store($request->name, (int)$request->desk_id);
        return response()->json($newTask, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $dateCarbon = $request->completed_at ? Carbon::createFromFormat('Y-m-d h:i:s', $request->completed_at) : null;
        $updatedItem = $this->task->updateItem(
            (int)$id,
            $request->name,
            (int)$request->sort,
            (bool)$request->completed,
            $dateCarbon
        );
        if ($updatedItem) {
            return response()->json($updatedItem);
        } else {
            return response()->json([], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $item = $this->task->deleteIfExist($id);
        if ($item) {
            return response()->json(['id' => (int)$id]);
        } else {
            return response()->json('', 204);
        }
    }

    public function sort(Request $request): \Illuminate\Http\JsonResponse
    {
        massUpdateService::massUpdate($request->getContent(), $this->task);
        return response()->json('', 204);
    }
}
