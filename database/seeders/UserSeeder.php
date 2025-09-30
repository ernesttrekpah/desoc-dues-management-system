<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::updateOrCreate(
            ['index_number' => 'SA001'],
            [
                'name'      => 'Super Admin',
                'email'     => 'superadmin@desoc.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'superadmin',
                'active'    => true,
                'is_locked' => false,
            ]
        );

        // Admin
        User::updateOrCreate(
            ['index_number' => 'AD001'],
            [
                'name'      => 'Admin User',
                'email'     => 'admin@desoc.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'admin',
                'active'    => true,
                'is_locked' => false,
            ]
        );

        // Student
        User::updateOrCreate(
            ['index_number' => 'ST001'],
            [
                'name'      => 'Student User',
                'email'     => 'student@desoc.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'student',
                'active'    => true,
                'is_locked' => false,
            ]
        );
    }
}
