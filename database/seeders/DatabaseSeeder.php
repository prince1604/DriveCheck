<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('user_types')->insertOrIgnore([
            ['id' => 1, 'type' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'type' => 'Employee', 'created_at' => now(), 'updated_at' => now()],
        ]);
        $this->command->info('User Types seeded successfully!');

        User::updateOrCreate(
            ['email' => 'admin@drivecheck.com'],
            [
                'name' => 'Super Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'user_type_id' => 1,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'employee@drivecheck.com'],
            [
                'employee_id' => 'EMP001',
                'name' => 'Test Employee',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'user_type_id' => 2,
                'is_active' => true,
                'policestation' => 'Botad HQ',
                'mobile_no' => '1234567890',
            ]
        );
        $this->command->info('Admin and Employee users seeded successfully!');
    }
}
