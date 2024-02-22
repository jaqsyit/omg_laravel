<?php


namespace App\Services\v1;

use App\Models\v1\Crust;
use App\Models\v1\Workers;
use Exception;
use Illuminate\Http\JsonResponse;

class WorkersService
{
    public function createWorker($data)
    {
        try {
            $existingWorker = Workers::where('surname', $data['surname'])
                ->where('name', $data['name'])
                ->first();
            if ($existingWorker) {
                return response()->json(['message' => 'Worker with the same name already exists'], 409);
            }
            $user = auth()->user();
            $data['user_id'] = $user->id;
            $newCrust = Crust::newCrust($data);
            $data['crust_id'] = $newCrust->id;
            $newWorker = Workers::newWorker($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'New worker added', 'worker' => $newWorker], 200);
    }

    public function deleteWorker($id)
    {
        $worker = Workers::find($id);
        if (!$worker) {
            return response()->json(['message' => 'Worker not found', 'worker' => $worker], 404);
        }
        $worker->delete();
        return response()->json(['success' => 'Worker deleted', 'worker' => $worker], 200);
    }

//    public function searchWorker($request)
//    {
//        $query = Workers::query();
//        if ($request->has('name')) {
//            $query->where('name', 'like', '%' . $request->input('name') . '%');
//        }
//        if ($request->has('job')) {
//            $query->where('job', 'like', '%' . $request->input('job') . '%');
//        }
//        if ($request->has('surname')) {
//            $query->where('surname', 'like', '%' . $request->input('surname') . '%');
//        }
//        if ($request->has('lastname')) {
//            $query->where('lastname', 'like', '%' . $request->input('lastname') . '%');
//        }
//        $results = $query->get();
//
//        return response() ->json(['result' => $results]);
//    }
}
