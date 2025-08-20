<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $students = Student::when($q, function ($query) use ($q) {
                $query->where('first_name', 'like', "%$q%")
                      ->orWhere('last_name', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'q'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Student::create($data);
        if ($request->expectsJson()) {
            return response()->json(['ok' => true, 'message' => 'Saved', 'redirect' => route('students.index')]);
        }
        return redirect()->route('students.index')->with('success', 'Saved');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $this->validateData($request, $student->id);
        $student->update($data);
        if ($request->expectsJson()) {
            return response()->json(['ok' => true, 'message' => 'Updated', 'redirect' => route('students.index')]);
        }
        return redirect()->route('students.index')->with('success', 'Updated');
    }

    public function destroy(Request $request, Student $student)
    {
        $student->delete();
        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }
        return back()->with('success', 'Deleted');
    }

    public function toggle(Request $request, Student $student)
    {
        $student->status = !$student->status;
        $student->save();
        if ($request->expectsJson()) {
            return response()->json(['ok' => true, 'status' => $student->status]);
        }
        return back();
    }

    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:students,email,' . ($id ?? 'NULL')],
            'contact_number' => ['nullable','string','max:50'],
            'date_of_birth' => ['nullable','date'],
            'gender' => ['nullable','in:male,female'],
            'type' => ['nullable','in:IT,Business,Arts'],
            'status' => ['required','boolean'],
            'description' => ['nullable','string'],
        ]);
    }
}
