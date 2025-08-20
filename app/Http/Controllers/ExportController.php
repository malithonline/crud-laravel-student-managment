<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    public function excel()
    {
        $rows = Student::orderBy('id')->get();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="students.csv"',
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID','First Name','Last Name','Email','Contact','DOB','Gender','Type','Status','Description']);
            foreach ($rows as $s) {
                fputcsv($out, [
                    $s->id,
                    $s->first_name,
                    $s->last_name,
                    $s->email,
                    $s->contact_number,
                    optional($s->date_of_birth)->format('Y-m-d'),
                    $s->gender,
                    $s->type,
                    $s->status ? 'Active' : 'Inactive',
                    $s->description,
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function xlsx()
    {
        if (!class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
            return $this->excel();
        }

        $students = Student::orderBy('id')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            'ID','First Name','Last Name','Email','Contact','DOB','Gender','Type','Status','Description'
        ], null, 'A1');

        $data = $students->map(function ($s) {
            return [
                $s->id,
                $s->first_name,
                $s->last_name,
                $s->email,
                $s->contact_number,
                optional($s->date_of_birth)->format('Y-m-d'),
                $s->gender,
                $s->type,
                $s->status ? 'Active' : 'Inactive',
                $s->description,
            ];
        })->toArray();

        if (!empty($data)) {
            $sheet->fromArray($data, null, 'A2');
        }

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'students.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);
    }

    public function pdf()
    {
        $students = Student::orderBy('id')->get();
        $pdf = Pdf::loadView('students.pdf', compact('students'));
        return $pdf->download('students.pdf');
    }
}
