<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DuesPayment;
use App\Models\Level;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DuesPaymentReportController extends Controller
{
    // Show the Dues Report page
    public function duesReport(Request $request)
    {
        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        $payments = collect(); // default empty
        $totals   = ['confirmed' => 0, 'pending' => 0, 'cancelled' => 0, 'overall' => 0];

        if ($request->filled('academic_year_id') && $request->filled('level_id')) {
            $payments = DuesPayment::with(['student.level', 'academicYear'])
                ->where('academic_year_id', $request->academic_year_id)
                ->where('level_id', $request->level_id)
                ->get();

            // Compute totals
            $totals['confirmed'] = $payments->where('status', 'confirmed')->sum('amount_paid');
            $totals['pending']   = $payments->where('status', 'pending')->sum('amount_paid');
            $totals['cancelled'] = $payments->where('status', 'cancelled')->sum('amount_paid');
            $totals['overall']   = $payments->sum('amount_paid');
        }

        return view('dashboard.reports.dues', compact('levels', 'academicYears', 'payments', 'totals'));
    }

    // Export PDF
    public function duesReportPdf(Request $request)
    {
        $query = DuesPayment::with(['student.level', 'academicYear']);

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        $payments = $query->get();

        $totals = [
            'confirmed' => $payments->where('status', 'confirmed')->sum('amount_paid'),
            'pending'   => $payments->where('status', 'pending')->sum('amount_paid'),
            'cancelled' => $payments->where('status', 'cancelled')->sum('amount_paid'),
            'overall'   => $payments->sum('amount_paid'),
        ];

        $pdf = Pdf::loadView('dashboard.reports.dues_pdf', compact('payments', 'totals'));
        return $pdf->download('dues_report.pdf');
    }
}
