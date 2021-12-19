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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $task = Task::where('competed', 1)->groupBy('desk_id')->orderBy('created_at', 'DESC')->get();
//        var_dump($task);
//        var_dump($task);
//        return $task;
//        $task = Task::where('completed', 1)->groupBy('desk_id')->get();
//        $task = Task::orderBy('updated_at')->get();
        $task = Task::all()->groupBy('desk_id');
//        $task = Task::where('desk_id', );
//        $task = Task::find(1);

//        $task = (new Task())->all()->orderBy('desk_id');
        return $task;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->task["name"];
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingTask = Task::find($id);

        if ($existingTask) {
            $existingTask->delete();
            return "Task successfully deleted";
        }

        return "Task not found";
    }
}
