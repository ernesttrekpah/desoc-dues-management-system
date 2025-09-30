<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Due;
use App\Models\DuesPayment;
use App\Models\Level;
use App\Models\Souvenir;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DuesPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = DuesPayment::with(['student.level', 'academicYear', 'souvenirs', 'due']);

        // Search by student name or index number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('index_number', 'like', "%{$search}%");
            });
        }

        // Filter by level
        if ($request->filled('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        // Filter by academic year
        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        //  Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(10)->appends($request->query());

        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        return view('dashboard.dues_payments.index', compact('payments', 'levels', 'academicYears'));
    }

    public function create()
    {
        $students      = Student::all();
        $dues          = Due::with(['level', 'academicYear'])->get();
        $souvenirs     = Souvenir::all();
        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        return view('dashboard.dues_payments.create', compact(
            'students', 'dues', 'souvenirs', 'levels', 'academicYears'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'       => 'required|exists:students,id',
            'due_id'           => 'required|exists:dues,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'level_id'         => 'required|exists:levels,id',
            'date_paid'        => 'required|date',
            'amount_paid'      => 'required|numeric|min:0',
            'status'           => 'required|in:pending,confirmed,cancelled',
        ]);

        // Create a unique receipt number,
        $receiptNumber = 'R-' . strtoupper(uniqid());

        // check if that receipt number already exists
        while (DuesPayment::where('receipt_number', $receiptNumber)->exists()) {
            $receiptNumber = 'R-' . strtoupper(uniqid());
        }

        $payment = DuesPayment::create($request->only([
            'student_id',
            'due_id',
            'academic_year_id',
            'level_id',
            'date_paid',
            'amount_paid',
            'receipt_number',
            'souvenir_collected',
            'status',
        ]));

        if ($request->has('souvenirs')) {
            $payment->souvenirs()->sync($request->souvenirs);
        }

        return redirect()->route('dues_payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function edit(DuesPayment $duesPayment)
    {
        $students      = Student::all();
        $dues          = Due::with(['level', 'academicYear'])->get();
        $souvenirs     = Souvenir::all();
        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        return view('dashboard.dues_payments.edit', compact(
            'duesPayment', 'students', 'dues', 'souvenirs', 'levels', 'academicYears'
        ));
    }

    public function update(Request $request, DuesPayment $duesPayment)
    {
        $request->validate([
            'student_id'       => 'required|exists:students,id',
            'due_id'           => 'required|exists:dues,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'level_id'         => 'required|exists:levels,id',
            'date_paid'        => 'required|date',
            'amount_paid'      => 'required|numeric|min:0',
            'status'           => 'required|in:pending,confirmed,cancelled',
        ]);

        $duesPayment->update($request->only([
            'student_id',
            'due_id',
            'academic_year_id',
            'level_id',
            'date_paid',
            'amount_paid',
            'souvenir_collected',
            'status',
        ]));

        if ($request->has('souvenirs')) {
            $duesPayment->souvenirs()->sync($request->souvenirs);
        } else {
            $duesPayment->souvenirs()->detach();
        }

        return redirect()->route('dues_payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(DuesPayment $duesPayment)
    {
        $duesPayment->delete();

        return redirect()->route('dues_payments.index')->with('success', 'Payment deleted successfully.');
    }

    public function exportPdf(Request $request)
    {
        $query = DuesPayment::with(['student.level', 'academicYear', 'souvenirs', 'due']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('index_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $duesPayments = $query->latest()->get();

        $pdf = Pdf::loadView('dashboard.dues_payments.pdf', compact('duesPayments'));
        return $pdf->download('dues_payments.pdf');
    }

    // Smart AJAX Endpoints

    public function getStudentInfo(Student $student)
    {
        return response()->json([
            'id'            => $student->id,
            'index_number'  => $student->index_number,
            'name'          => $student->name,
            'level'         => $student->level,
            'academic_year' => $student->academicYear,
        ]);
    }

    public function getSouvenirs($level_id, $academic_year_id)
    {
        $souvenirs = Souvenir::where('level_id', $level_id)
            ->where('academic_year_id', $academic_year_id)
            ->where('status', 'available')
            ->get(['id', 'name']);

        return response()->json($souvenirs);
    }

    public function getStudentsByYearAndLevel($academic_year_id, $level_id)
    {
        $students = Student::where('academic_year_id', $academic_year_id)
            ->where('level_id', $level_id)
            ->get(['id', 'index_number', 'name']);

        return response()->json($students);
    }

}
