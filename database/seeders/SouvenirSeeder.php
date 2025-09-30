<?php
namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\Souvenir;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SouvenirSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $levels        = Level::all();
        $academicYears = AcademicYear::all();

        if ($levels->isEmpty() || $academicYears->isEmpty()) {
            $this->command->warn('Levels or Academic Years missing — seed them first.');
            return;
        }

        foreach (range(1, 15) as $i) {
            Souvenir::create([
                'name'             => $faker->randomElement(['T-shirt', 'Pen', 'Mug', 'Cap', 'Notebook']),
                'level_id'         => $levels->random()->id,
                'academic_year_id' => $academicYears->random()->id,
                'description'      => $faker->sentence(8),
                'status'           => $faker->randomElement(['available', 'unavailable']),
            ]);
        }
    }
}
