<?php
namespace App\Http\Controllers;

use App\Models\Level;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the levels.
     */
    public function index()
    {
        $levels = Level::latest()->paginate(10);
        return view('dashboard.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new level.
     */
    public function create()
    {
        return view('dashboard.levels.create');
    }

    /**
     * Store a newly created level.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number'      => 'required|integer|unique:levels,number',
            'description' => 'nullable|string',
        ]);

        Level::create([
            'number' => $request->number,
            'name'   => "Level {$request->number}", // auto-generate
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.levels')
            ->with('success', 'Level created successfully.');
    }

    /**
     * Show the form for editing the specified level.
     */
    public function edit(Level $level)
    {
        return view('dashboard.levels.edit', compact('level'));
    }

    /**
     * Update the specified level.
     */
    public function update(Request $request, Level $level)
    {
        $request->validate([
            'number'      => 'required|integer|unique:levels,number,' . $level->id,
            'description' => 'nullable|string',
        ]);

        $level->update([
            'number' => $request->number,
            'name'   => "Level {$request->number}",
            'description' => $request->description,
        ]);

        return redirect()->route('levels.index')
            ->with('success', 'Level updated successfully.');
    }

    /**
     * Remove the specified level.
     */
    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('levels.index')
            ->with('success', 'Level deleted successfully.');
    }

    /**
     * Export all levels as PDF.
     */
    public function exportPdf()
    {
        $levels = Level::all();
        $pdf    = Pdf::loadView('dashboard.levels.pdf', compact('levels'));
        return $pdf->download('levels.pdf');
    }
}
