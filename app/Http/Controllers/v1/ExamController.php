<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\exam;
use App\Services\v1\ExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    /**
     * @param ExamService $service
     * @return JsonResponse
     */

    protected $service;

    public function __construct(ExamService $service)
    {
        $this->ExamService = $service;
    }

    public function index()
    {
        $response = exam::all();
        return response()->json($response);
    }

    public function create(Request $request)
    {
        return $this->ExamService->createNewExam($request);
    }



    public function getResWorker($id)
    {
        return $this->ExamService->getResultWorker($id);
    }

    public function actionCheckCode(Request $request){
        return $this->ExamService->checkCode($request);
    }

    public function actionStartExam(Request $request){
        return $this->ExamService->startExam($request);
    }

    public function actionEndExam(Request $request){
        return $this->ExamService->endExam($request);
    }
}
