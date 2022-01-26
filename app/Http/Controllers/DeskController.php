<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\Batch;


class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desks = Desk::select('*')->orderBy('sort')->get();
        foreach ($desks as $desk) {
            $desk['tasks'] = $desk->sortTasks('asc');
        }
        return $desks;
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
        $newDesk = new Desk;
        $newDesk->name = $request->name;
        $newDesk->sort = Desk::maxSort() + 1;
        $saved = $newDesk->save();
        if ($saved) {
            return response()->json($newDesk, 201);
        } else {
            return response()->json('', 204);
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $existingDesk = Desk::find($id);

        if ($existingDesk) {
            $existingDesk->name = $request->name;
            $existingDesk->completed = $request->completed ? true : false;
            $existingDesk->completed_at = $request->completed_at ? Carbon::now() : null;
            $existingDesk->save();
            return response()->json($existingDesk, 200);
        } else {
            return response()->json([], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $existingDesk = Desk::find($id);

        if ($existingDesk) {
            $existingDesk->delete();
            return response()->json(['id' => (int)$id]);
        } else {
            return response()->json('', 204);
        }
    }

    public function sort(Request $request): \Illuminate\Http\JsonResponse
    {
        $sort = json_decode($request->getContent());
        $sorting = [];
        foreach ($sort as $item) {
            $item = json_decode(json_encode($item), true);
            $sorting[] = [
                'id' => $item['id'],
                'sort' => $item['sort']
            ];
        }
        batch()->update((new Desk()), $sorting, 'id');
        return response()->json('', 204);
    }
}
