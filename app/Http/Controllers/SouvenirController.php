<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\Souvenir;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function index()
    {
        $souvenirs = Souvenir::with(['level', 'academicYear'])->latest()->paginate(10);
        return view('dashboard.souvenirs.index', compact('souvenirs'));
    }

    public function create()
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();
        return view('dashboard.souvenirs.create', compact('levels', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string',
            'level_id'         => 'required|exists:levels,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'description'      => 'nullable|string',
            'status'           => 'required|in:available,unavailable',
        ]);

        Souvenir::create($request->all());

        return redirect()->route('souvenirs.index')->with('success', 'Souvenir created successfully.');
    }

    public function edit(Souvenir $souvenir)
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();
        return view('dashboard.souvenirs.edit', compact('souvenir', 'levels', 'academicYears'));
    }

    public function update(Request $request, Souvenir $souvenir)
    {
        $request->validate([
            'name'             => 'required|string',
            'level_id'         => 'required|exists:levels,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'description'      => 'nullable|string',
            'status'           => 'required|in:available,unavailable',
        ]);

        $souvenir->update($request->all());

        return redirect()->route('souvenirs.index')->with('success', 'Souvenir updated successfully.');
    }

    public function destroy(Souvenir $souvenir)
    {
        $souvenir->delete();
        return redirect()->route('souvenirs.index')->with('success', 'Souvenir deleted successfully.');
    }

    public function exportPdf()
    {
        $souvenirs = Souvenir::with(['level', 'academicYear'])->get();
        $pdf       = Pdf::loadView('dashboard.souvenirs.pdf', compact('souvenirs'));
        return $pdf->download('souvenirs.pdf');
    }
}
