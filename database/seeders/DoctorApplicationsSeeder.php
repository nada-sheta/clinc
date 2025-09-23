<?php

namespace Database\Seeders;

use App\Models\DoctorApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DoctorApplication::insert([
            [
                'name' => 'Dr. Ahmed Nabil',
                'email' => 'ahmed@clinic',
                'major' => 'Cardiology',
                'phone' => '01012345678',
                'degree_certificate' => 'assets/images/degree_certificate1.jpg',
                'session_price' => 300.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Salma Youssef',
                'email' => 'salma@clinic',
                'major' => 'Dermatology',
                'phone' => '01123456789',
                'degree_certificate' => 'assets/images/degree_certificate2.jpg',
                'session_price' => 250.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
