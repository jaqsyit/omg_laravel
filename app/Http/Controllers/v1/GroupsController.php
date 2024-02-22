<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Groups;
use App\Services\v1\GroupsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * @param GroupsService $service
     * @return JsonResponse
     */

    protected $GroupsService;

    public function __construct(GroupsService $GroupsService)
    {
        $this->GroupsService = $GroupsService;
    }

    public function index()
    {
        $allData = Groups::with('exam')->with('exam.workers')->with('exam.workers.org')->get();
        return response()->json(['data' => $allData], 200);
    }


    public function create(Request $request)
    {
        return $this->GroupsService->createGroup($request->all());
    }

    public function update(Request $request, Groups $workers)
    {
        //
    }

    public function destroy($id)
    {
        return $this->GroupsService->deleteGroup($id);
    }
}
