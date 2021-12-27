<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Task[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all()->groupBy('desk_id');
        return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Task
     */
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->task["name"];
        $newTask->desk_id = $request->task["desk_id"];
        $newTask->save();
        return $newTask;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $existingTask = Task::find($id);

        if ($existingTask) {
            $existingTask->name = $request->task['name'];
            $existingTask->completed = $request->task['completed'] ? true : false;
            $existingTask->completed_at = $request->task['completed'] ? Carbon::now() : null;
            $existingTask->save();
            return $existingTask;
        }
        return "Task not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        $existingTask = Task::find($id);

        if ($existingTask) {
            $existingTask->delete();
            return $id;
        }

        return "Task not found";
    }
}
