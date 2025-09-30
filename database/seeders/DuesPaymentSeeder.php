<?php
namespace Database\Seeders;

use App\Models\Due;
use App\Models\DuesPayment;
use App\Models\Souvenir;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DuesPaymentSeeder extends Seeder
{
    public function run(): void
    {
        $students  = Student::all();
        $dues      = Due::with(['academicYear', 'level'])->get();
        $souvenirs = Souvenir::all();

        foreach ($students as $student) {
            $due = $dues->where('level_id', $student->level_id)
                ->where('academic_year_id', $student->academic_year_id)
                ->first();

            if (! $due) {
                continue; // skip if no matching due
            }

            $payment = DuesPayment::create([
                'student_id'         => $student->id,
                'due_id'             => $due->id,
                'academic_year_id'   => $due->academic_year_id,
                'level_id'           => $due->level_id,
                'date_paid'          => Carbon::now()->subDays(rand(1, 365)),
                'amount_paid'        => $due->amount,
                'receipt_number'     => 'R-' . strtoupper(uniqid()),
                'souvenir_collected' => rand(0, 1),
                'status'             => ['pending', 'confirmed', 'cancelled'][rand(0, 2)],
            ]);

            // randomly attach souvenirs (if any exist for this level & year)
            $availableSouvenirs = $souvenirs->where('level_id', $due->level_id)
                ->where('academic_year_id', $due->academic_year_id);

            if ($availableSouvenirs->count() > 0 && rand(0, 1)) {
                $payment->souvenirs()->attach(
                    $availableSouvenirs->random(rand(1, $availableSouvenirs->count()))->pluck('id')->toArray()
                );
            }
        }
    }
}
