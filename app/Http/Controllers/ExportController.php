<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf()
    {
        $students = Student::orderBy('id')->get();
        $pdf = Pdf::loadView('students.pdf', compact('students'));
        return $pdf->download('students.pdf');
    }
}
