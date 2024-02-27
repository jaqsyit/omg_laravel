<?php


namespace App\Services\v1;

use App\Models\v1\exam;
use App\Models\v1\Workers;
use Exception;
use Illuminate\Http\JsonResponse;
use PhpOffice\PhpWord\IOFactory;

class ExamService
{
    public function createNewExam($data)
    {
        try {
            $exExam = exam::where('worker_id', $data['worker_id'])
                ->where('group_id', $data['group_id'])
                ->first();
            if ($exExam) {
                return response()->json(['message' => 'Exam with the same name already exists'], 409);
            }
            $newExam = exam::newExam($data);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'New exam added', 'exam' => $newExam], 200);
    }

    public function checkCode($data)
    {
        try {
            $exam = exam::where('access_code', $data['access_code'])->with('group')->with('workers.org')->first();
            if (!$exam) {
                return response()->json(['message' => 'Exam not found'], 404);
            }
            if ($exam->created_at != $exam->updated_at) {
                return response()->json(['message' => 'Exam passed'], 409);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Exam founded', 'exam' => $exam], 200);
    }

    public function getResultWorker($workerId)
    {
        $data = exam::where('worker_id', $workerId)
            ->with('workers', 'group')
            ->get();

        if (!$data->isEmpty()) {
            $result = $data->map(function ($exam) {
                return [
                    'exam_id' => $exam->id,
                    'worker_fullname' => $exam->workers->surname . ' ' . $exam->workers->name . ' ' . $exam->workers->lastname,
                    'subject' => $exam->group->subject,
                    'passed' => $exam->pass,
//                    'exam_date' => $exam->created_at->format('Y-m-d H:i:s')
                ];
            })->toArray();
        }
        return response()->json($result);
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

    public function startExam($data)
    {
        try {
            $exam = exam::where('access_code', $data['accessCode'])->with('group')->with('workers.org')->first();
            if (!$exam) {
                return response()->json(['message' => 'Exam not found'], 404);
            }
            if ($exam->created_at != $exam->updated_at or $exam->updated_at == null) {
                return response()->json(['message' => 'Exam passed'], 409);
            }
//            $startedExam = exam::where('id', $exam->id)->update(['pass' => false]);
            $subject = $exam['group']['subject'];
            switch ($subject) {
                case 'Өрт-техникалық минимум':
                    $pathRaw = 'ptm';
                    break;
                case 'Өнеркәсіп қауіпсіздігі':
                    $pathRaw = 'pb';
                    break;
                case 'Еңбек қауіпсіздігі және еңбекті қорғау':
                    $pathRaw = 'ekek';
                    break;
                default:
                    $pathRaw = '';
            }
            $pathRaw .= '_' . $data['language'];

            $chin = $exam['group']['chin'];
            switch ($chin) {
                case 'ИТР':
                    $pathRaw .= '_itr';
                    break;
                case 'Рабочий':
                    $pathRaw .= '_rab';
                    break;
                default:
                    $pathRaw .= '';
            }

            $pathRaw .= '.docx';

            $reader = IOFactory::createReader('Word2007');
            $path = storage_path('app/private/' . $pathRaw);
            $phpWord = $reader->load($path);
            $questions = [];
            $currentQuestion = null;

            foreach ($phpWord->getSections() as $section) {
                $elements = $section->getElements();

                foreach ($elements as $element) {
                    if (get_class($element) === 'PhpOffice\PhpWord\Element\TextRun') {
                        foreach ($element->getElements() as $textElement) {
                            if (get_class($textElement) === 'PhpOffice\PhpWord\Element\Text') {
                                $text = $textElement->getText();
                                // Проверка на формат нумерации
                                if (preg_match('/^\d+\.\s*$/', $text)) {
                                    continue; // Пропустить нумерацию
                                }
                                if ($textElement->getFontStyle() && $textElement->getFontStyle()->isBold()) {
                                    if ($currentQuestion) {
                                        $questions[] = $currentQuestion;
                                    }
                                    $currentQuestion = [
                                        'question' => $text,
                                        'options' => [],
                                        'correct_option' => null
                                    ];
                                } elseif ($currentQuestion) {
                                    if ($text == "*") {
                                        $currentQuestion['correct_option'] = count($currentQuestion['options']) - 1;
                                    } else {
                                        $currentQuestion['options'][] = $text;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($currentQuestion) {
                $questions[] = $currentQuestion;
            }


            $quantity = $exam->group->quantity;
            $generatedQuestions = [];

            while (count($generatedQuestions) < $quantity) {
                foreach ($questions as $question) {
                    $generatedQuestions[] = $question;
                    if (count($generatedQuestions) == $quantity) {
                        break;
                    }
                }
            }

            shuffle($generatedQuestions);

            foreach ($generatedQuestions as &$gQuestion) {
                $correctOptionIndex = $gQuestion['correct_option'];
                if (isset($gQuestion['options'][$correctOptionIndex])) {
                    $correctOption = $gQuestion['options'][$correctOptionIndex];
                    shuffle($gQuestion['options']);
                    $gQuestion['correct_option'] = array_search($correctOption, $gQuestion['options']);
                }
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Start', 'questions' => $generatedQuestions], 200);
    }


    public function endExam($data)
    {
        try {
            $exam = exam::where('access_code', $data['accessCode'])->with('group')->with('workers.org')->first();
            if (!$exam) {
                return response()->json(['message' => 'Exam not found'], 404);
            }
            if ($exam->created_at != $exam->updated_at or $exam->updated_at == null) {
                return response()->json(['message' => 'Exam passed'], 409);
            }

            if ($data['right_count'] >= $exam->group->passed_on) {
                $passed = true;
            } else {
                $passed = false;
            }

            $updatePass = exam::where('id', $exam->id)->update(['pass' => $passed, 'created_at' => $exam->group->start]);

            if ($updatePass == 0) {
                return response()->json(['message' => 'Экзамен аяқтау мүмкін емес'], 409);
            }

            $exam = exam::where('access_code', $data['accessCode'])->with('group')->with('workers.org')->first();

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'End', 'questions' => $exam], 200);
    }
}
