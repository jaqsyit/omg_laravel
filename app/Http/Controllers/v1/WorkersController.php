<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Workers;
use App\Services\v1\WorkersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    /**
     * @param WorkersService $service
     * @return JsonResponse
     */

    protected $WorkersService;

    public function __construct(WorkersService $WorkersService)
    {
        $this->WorkersService = $WorkersService;
    }

    public function index()
    {
        $allData = Workers::allWorkers();
        return response()->json(['data' => $allData],200);
    }

    public function create(Request $request)
    {
        return $this->WorkersService->createWorker($request->all());
    }

    public function update(Request $request, Workers $workers)
    {
        //
    }

    public function destroy($id)
    {
        return $this->WorkersService->deleteWorker($id);
    }

//    public function searchWorker(Request $request)
//    {
//        return $this->WorkersService->searchWorker($request->all());
//    }
}
