<?php
namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            [
                'name'        => '2022/2023',
                'description' => 'Previous academic year',
            ],
            [
                'name'        => '2023/2024',
                'description' => 'Ongoing academic year',
            ],
            [
                'name'        => '2024/2025',
                'description' => 'Upcoming academic year',
            ],
            [
                'name'        => '2025/2026',
                'description' => 'Planned academic year',
            ],
        ];

        foreach ($years as $year) {
            AcademicYear::updateOrCreate(
                ['name' => $year['name']], // avoid duplicates
                $year
            );
        }
    }
}
