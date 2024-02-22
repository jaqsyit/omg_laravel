<?php


namespace App\Services\v1;

use App\Models\v1\exam;
use App\Models\v1\Groups;
use Exception;
use Illuminate\Http\JsonResponse;

class GroupsService
{
    public function createGroup($data)
    {
        try {
            if (array_key_exists('idGroup', $data)) {
                $group = Groups::find($data['idGroup']);
                if ($group) {
                    $group->update([
                        'start' => $data['start'],
                        'end' => $data['end'],
                        'passed_on' => $data['passed_on'],
                        'quantity' => $data['quantity'],
                        'commission' => $data['commission'],
                        'chin' => $data['chin'],
                        'subject' => $data['subject']
                    ]);
                    $exams = exam::where('group_id', $group->id)->get();

                    return response()->json(['success' => 'Group updated', 'group' => $group, 'exams' => $exams], 200);
                }
            } else {
//                dd('test');
                $group = Groups::newGroup($data);
                if (isset($group->id)) {
                    $data['group_id'] = $group->id;
                    $exams = [];
                    foreach ($data['workers'] as $index => $workerId) {
                        $data['worker_id'] = $workerId;
                        $newExam = exam::newExam($data);
                        $exams[] = $newExam;
                    }
                    $group['user_id'] = intval($group['user_id']);
                    $group['quantity'] = intval($group['quantity']);
                    $group['passed_on'] = intval($group['passed_on']);

                    $exams = exam::where('group_id', $group->id)->get();

                    return response()->json(['success' => 'New group added', 'group' => $group, 'exams' => $exams], 200);
                }
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function deleteGroup($id)
    {
        $group = Groups::find($id);
        if (!$group) {
            return response()->json(['message' => 'Group not found', 'group' => $group], 404);
        }

        $group->exam()->delete();

        $group->delete();
        return response()->json(['success' => 'Group deleted', 'group' => $group], 200);
    }



//    public function searchGroup($request)
//    {
//        $query = Groups::query();
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
