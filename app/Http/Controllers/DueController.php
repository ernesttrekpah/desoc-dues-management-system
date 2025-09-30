<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Due;
use App\Models\Level;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DueController extends Controller
{
    public function index()
    {
        $dues = Due::with(['academicYear', 'level'])->latest()->paginate(10);
        return view('dashboard.dues_setup.index', compact('dues'));
    }

    public function create()
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();
        return view('dashboard.dues_setup.create', compact('levels', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'level_id'         => 'required|exists:levels,id',
            'amount'           => 'required|numeric|min:0',
            'status'           => 'required|in:active,inactive',
        ]);

        Due::create($request->all());

        return redirect()->route('dues.index')->with('success', 'Due created successfully.');
    }

    public function edit(Due $due)
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();
        return view('dashboard.dues_setup.edit', compact('due', 'levels', 'academicYears'));
    }

    public function update(Request $request, Due $due)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'level_id'         => 'required|exists:levels,id',
            'amount'           => 'required|numeric|min:0',
            'status'           => 'required|in:active,inactive',
        ]);

        $due->update($request->all());

        return redirect()->route('dues.index')->with('success', 'Due updated successfully.');
    }

    public function destroy(Due $due)
    {
        $due->delete();
        return redirect()->route('dues.index')->with('success', 'Due deleted successfully.');
    }

    public function exportPdf()
    {
        $dues = Due::with(['academicYear', 'level'])->get();
        $pdf  = Pdf::loadView('dashboard.dues_setup.pdf', compact('dues'));
        return $pdf->download('dues.pdf');
    }
}
