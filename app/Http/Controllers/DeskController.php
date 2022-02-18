<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\Task;
use App\Services\massUpdateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\Batch;


class DeskController extends Controller
{
    protected Desk $desk;

    public function __construct(Desk $desk)
    {
        $this->desk = $desk;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->desk->sortedDesks();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newDesk = $this->desk->store($request->name);
        if ($newDesk) {
            return response()->json($newDesk, 201);
        } else {
            return response()->json('', 204);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $dateCarbon = Carbon::createFromFormat('Y-m-d h:m:s', $request->completed_at);
        $updatedDesk = $this->desk->updateDesk(
            (int)$id,
            $request->name,
            (bool)$request->completed,
            $dateCarbon);
        if ($updatedDesk) {
            return response()->json($updatedDesk);
        } else {
            return response()->json([], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $existingDesk = $this->desk->deleteIfExist((int)$id);

        if ($existingDesk) {
            return response()->json(['id' => (int)$id]);
        } else {
            return response()->json('', 204);
        }
    }

    public function sort(Request $request): \Illuminate\Http\JsonResponse
    {
        massUpdateService::massUpdate($request->getContent(), $this->desk);
        return response()->json('', 204);
    }
}
