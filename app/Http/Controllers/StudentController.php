<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['level', 'academicYear'])->latest()->paginate(10);
        return view('dashboard.students.index', compact('students'));
    }

    public function create()
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        return view('dashboard.students.create', compact('levels', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'index_number'     => 'required|string|unique:students,index_number',
            'name'             => 'required|string',
            'email'            => 'nullable|email|unique:students,email',
            'phone'            => 'nullable|string',
            'level_id'         => 'required|exists:levels,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'address'          => 'nullable|string',
            'status'           => 'required|in:active,inactive,graduated',
        ]);

        Student::create($request->only([
            'index_number',
            'name',
            'email',
            'phone',
            'level_id',
            'academic_year_id',
            'address',
            'status',
        ]));

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function edit(Student $student)
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        return view('dashboard.students.edit', compact('student', 'levels', 'academicYears'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'index_number'     => 'required|string|unique:students,index_number,' . $student->id,
            'name'             => 'required|string',
            'email'            => 'nullable|email|unique:students,email,' . $student->id,
            'phone'            => 'nullable|string',
            'level_id'         => 'required|exists:levels,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'address'          => 'nullable|string',
            'status'           => 'required|in:active,inactive,graduated',
        ]);

        $student->update($request->only([
            'index_number',
            'name',
            'email',
            'phone',
            'level_id',
            'academic_year_id',
            'address',
            'status',
        ]));

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function exportPdf()
    {
        $students = Student::with(['level', 'academicYear'])->get();
        $pdf      = Pdf::loadView('dashboard.students.pdf', compact('students'));
        return $pdf->download('students.pdf');
    }
}
