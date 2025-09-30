<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SouvenirSeeder::class);
        $this->call(DueSeeder::class);
        $this->call(DuesPaymentSeeder::class);

    }
}
