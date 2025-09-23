<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        Doctor::insert([
            [
                'name' => 'Dr.AHMED',
                'image' => 'assets/images/01.jpg',
                'description' => 'Experienced and trusted medical professional',
                'major_id' => 1,
                'account_doctor' => 1,
                'booking_price' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.MOSTAFA',
                'image' => 'assets/images/02.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 4,
                'account_doctor' => 2,
                'booking_price' => 450,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.NOAH',
                'image' => 'assets/images/03.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 2,
                'account_doctor' => 3,
                'booking_price' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.HEND',
                'image' => 'assets/images/04.jpg',
                'description' => 'She is specialized in the field of medicine and has extensive experience.',
                'major_id' => 2,
                'account_doctor' => 4,
                'booking_price' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.EDWARD',
                'image' => 'assets/images/05.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 5,
                'account_doctor' => 5,
                'booking_price' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.CHARLES',
                'image' => 'assets/images/06.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 3,
                'account_doctor' => 6,
                'booking_price' => 700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.JASMINE',
                'image' => 'assets/images/07.jpg',
                'description' => 'She is specialized in the field of medicine and has extensive experience.',
                'major_id' => 3,
                'account_doctor' => 7,
                'booking_price' => 900,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.FARAH',
                'image' => 'assets/images/08.jpg',
                'description' => 'She is specialized in the field of medicine and has extensive experience.',
                'major_id' => 4,
                'account_doctor' => 8,
                'booking_price' => 750,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.NADA',
                'image' => 'assets/images/09.jpg',
                'description' => 'She is specialized in the field of medicine and has extensive experience.',
                'major_id' => 1,
                'account_doctor' => 9,
                'booking_price' => 670,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.REDA',
                'image' => 'assets/images/10.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 5,
                'account_doctor' => 10,
                'booking_price' => 800,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.TAMER',
                'image' => 'assets/images/11.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 1,
                'account_doctor' => 11,
                'booking_price' => 550,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr.JOSEPH',
                'image' => 'assets/images/12.jpg',
                'description' => 'He is specialized in the field of medicine and has extensive experience.',
                'major_id' => 3,
                'account_doctor' => 12,
                'booking_price' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
