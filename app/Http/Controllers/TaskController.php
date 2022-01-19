<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Task[]
     */
    public function index()
    {
        return Task::all()->groupBy('desk_id');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->name;
        $newTask->desk_id = $request->desk_id;
        $newTask->save();
        return response()->json($newTask, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $existingTask = Task::find($id);

        if ($existingTask) {
            $existingTask->name = $request->name;
            $existingTask->completed = $request->completed ? true : false;
            $existingTask->completed_at = $request->completed_at ? Carbon::now() : null;
            $existingTask->save();
            return response()->json($existingTask, 204);
        } else {
            return response()->json([], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $existingTask = Task::find($id);

        if ($existingTask) {
            $existingTask->delete();
            return response()->json(['id' => (int)$id]);
        } else {
            return response()->json('', 204);
        }
    }
}
