<?php
namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure at least a few levels exist
        $levels = Level::all();
        if ($levels->isEmpty()) {
            $levels = collect([
                Level::create(['number' => 100, 'name' => 'Level 100', 'description' => 'Default seeded level']),
                Level::create(['number' => 200, 'name' => 'Level 200', 'description' => 'Default seeded level']),
                Level::create(['number' => 300, 'name' => 'Level 300', 'description' => 'Default seeded level']),
            ]);
        }

        // Ensure at least one academic year exists
        $academicYears = AcademicYear::all();
        if ($academicYears->isEmpty()) {
            $academicYears = collect([
                AcademicYear::create(['name' => '2023/2024', 'description' => 'Seeded year']),
                AcademicYear::create(['name' => '2024/2025', 'description' => 'Seeded year']),
            ]);
        }

        // Generate 30 fake students
        foreach (range(1, 30) as $i) {
            Student::updateOrCreate(
                ['index_number' => 'STU' . str_pad($i, 3, '0', STR_PAD_LEFT)], // e.g., STU001
                [
                    'name'             => $faker->name,
                    'email'            => $faker->unique()->safeEmail,
                    'phone'            => $faker->phoneNumber,
                    'level_id'         => $levels->random()->id,
                    'academic_year_id' => $academicYears->random()->id,
                    'address'          => $faker->address,
                    'status'           => $faker->randomElement(['active', 'inactive', 'graduated']),
                ]
            );
        }
    }
}
