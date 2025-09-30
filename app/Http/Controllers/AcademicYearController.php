<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::latest()->paginate(10);
        return view('dashboard.academic_year.index', compact('academicYears'));
    }

    public function create()
    {
        return view('dashboard.academic_year.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|unique:academic_years,name|regex:/^\d{4}\/\d{4}$/',
            'description' => 'nullable|string',
        ]);

        AcademicYear::create($request->only('name', 'description'));

        return redirect()->route('academic_year.index')
            ->with('success', 'Academic Year created successfully.');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('dashboard.academic_year.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'name'        => 'required|string|regex:/^\d{4}\/\d{4}$/|unique:academic_years,name,' . $academicYear->id,
            'description' => 'nullable|string',
        ]);

        $academicYear->update($request->only('name', 'description'));

        return redirect()->route('dashboard.academic_year')
            ->with('success', 'Academic Year updated successfully.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()->route('dashboard.academic_year')
            ->with('success', 'Academic Year deleted successfully.');
    }

    public function exportPdf()
    {
        $academicYears = AcademicYear::all();
        $pdf           = Pdf::loadView('dashboard.academic_year.pdf', compact('academicYears'));
        return $pdf->download('academic_years.pdf');
    }
}
