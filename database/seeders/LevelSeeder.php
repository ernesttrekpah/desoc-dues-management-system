<?php
namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'number'      => 100,
                'name'        => 'Level 100',
                'description' => 'Freshman level — introductory courses and foundation studies.',
            ],
            [
                'number'      => 200,
                'name'        => 'Level 200',
                'description' => 'Sophomore level — intermediate courses, some specialization begins.',
            ],
            [
                'number'      => 300,
                'name'        => 'Level 300',
                'description' => 'Junior level — advanced courses, deeper specialization.',
            ],
            [
                'number'      => 400,
                'name'        => 'Level 400',
                'description' => 'Senior level — final year, capstone projects, thesis and practicals.',
            ],
        ];

        foreach ($levels as $level) {
            Level::updateOrCreate(
                ['number' => $level['number']], // prevent duplicates
                $level
            );
        }
    }
}
