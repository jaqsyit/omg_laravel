<?php

namespace App\Http\Controllers\v1;

use App\Models\v1\exam;
use App\Models\v1\Groups;
use App\Models\v1\User;
use App\Models\v1\Workers;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Mpdf;

class PdfController
{
    public function pdfAccessCodes($id)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',]);

        $exams = exam::where('group_id', $id)->get();
        if (!$exams) {
            return response()->json(['message' => 'Exam not found'], 404);
        }
        $group = Groups::where('id', $id)->first();
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $user = User::where('id', $group->user_id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $workers = Workers::whereIn('id', $exams->pluck('worker_id'))->get();
        $data = [];

        foreach ($exams as $exam) {
            $worker = $workers->where('id', $exam->worker_id)->first();
            $fio = "{$worker->surname} {$worker->name} {$worker->lastname}";
            $data[$fio] = $exam->access_code;
        }

        $html = '<b>Пән:</b> ' . $group->subject . '<br>';
        $html .= '<b>Тобы:</b> ' . $group->chin . '<br>';
        $html .= '<b>Комиссия:</b> ' . $group->commission . '<br>';
        $html .= '<b>Басталуы:</b> ' . $group->start . '<br>';
        $html .= '<b>Аяқталуы:</b> ' . $group->end . '<br>';
        $html .= '<b>Тағайындаушы:</b> ' . $user->surname . ' ' . $user->name . ' ' . $user->lastname . '<br>';
        $html .= '<br>';


        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">№</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">ФИО</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">Код</th>';
        $html .= '</tr>';

        $counter = 1;

        foreach ($data as $fio => $accessCode) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 5px;">' . $counter . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 5px;">' . $fio . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 5px;">' . $accessCode . '</td>';
            $html .= '</tr>';

            $counter++;
        }

        $html .= '</table>';

        $mpdf->WriteHTML($html);

        $filename = 'access_codes_' . $id . '.pdf';
        $filePath = "public/{$filename}";

        Storage::put($filePath, $mpdf->Output('', 'S'));
        $url = Storage::url($filePath);
        if (Storage::exists($filePath)) {
            $fileContents = Storage::get($filePath);
            return Storage::download($filePath);
//            return response()->json(['success' => 'https://omg-koo.kz' . $url], 200);
//            return response()->json(['success' => 'https://localhost' . $url], 200);
            return response()->json(['success' => 'https://backend.omg-koo.kz' . $url], 200);


//            return Response::make($fileContents, 200, [
//                'Content-Type' => 'application/pdf',
//                'Content-Disposition' => 'inline; filename="' . $filename . '"'
//            ]);
        } else {
            // Если файл не найден, можно вернуть ошибку
            return response()->json(['error' => 'File not found.'], 404);
        }


    }


    public function resultWorker($workerId)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',]);
        $mpdf->setBasePath(public_path());

        $exams = exam::where('worker_id', $workerId)->first();
        if (!$exams) {
            return response()->json(['message' => 'Exam not found'], 404);
        }
        $worker = Workers::where('id', $workerId)->first();
        if (!$worker) {
            return response()->json(['message' => 'Worker not found'], 404);
        }
        $group = Groups::where('id', $exams->group_id)->first();
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        $user = User::where('id', $group->user_id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $fio = "{$worker->surname} {$worker->name} {$worker->lastname}";
        $protocolNumber = $exams->id;
        $subject = $group->subject;

        switch ($subject) {
            case 'Өрт-техникалық минимум':
                $headerImg = '/images/otm_header.png';
            case 'Өнеркәсіп қауіпсіздігі':
                $headerImg = '/images/ok_header.png';
            case 'Еңбек қауіпсіздігі және еңбекті қорғау':
                $headerImg = '/images/ekek_header.png';
            default:
                $headerImg = '/images/ok_header.png';
        }


        $html = '<img src="' . public_path() . $headerImg . '" alt="Логотип">';
        $html .= '<b>Хаттама №</b> ' . $protocolNumber . $exams->updated_at;
        $html .= '<br>';
        $html .= $subject . ' пәні бойынша ' . $fio . ' емтихан нәтижесі';
        $html .= '<br>';


        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">ФИО</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">Тобы</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">Тестілеу түрі</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">Дұрыс жауаптар саны</th>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">' . $fio . '</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">' . $subject . '</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">Емтихан</th>';
        $html .= '<th style="border: 1px solid #000; padding: 5px;">5/30</th>';
        $html .= '</tr>';

        $html .= '</table>';

        $mpdf->WriteHTML($html);

        $pdfContent = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="example.pdf"');

    }


}
