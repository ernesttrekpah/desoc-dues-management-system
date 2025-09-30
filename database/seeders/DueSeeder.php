<?php
namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Due;
use App\Models\Level;
use Illuminate\Database\Seeder;

class DueSeeder extends Seeder
{
    public function run(): void
    {
        $academicYears = AcademicYear::all();
        $levels        = Level::all();

        foreach ($academicYears as $year) {
            foreach ($levels as $level) {
                Due::create([
                    'academic_year_id' => $year->id,
                    'level_id'         => $level->id,
                    'amount'           => rand(50, 150), // random GH₵ amount
                    'status'           => 'active',
                ]);
            }
        }
    }
}
