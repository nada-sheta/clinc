<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        Major::insert([
            [
                'name' => '(Pediatrics)',
                'image' => 'assets/images/Pediatrics.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '(Obstetrics and Gynecology)',
                'image' => 'assets/images/Obstetrics and Gynecology.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '(Dermatology)',
                'image' => 'assets/images/Dermatology.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '(Ophthalmology)',
                'image' => 'assets/images/Ophthalmology.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '(Dentistry)',
                'image' => 'assets/images/Dentistry.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
