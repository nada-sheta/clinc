<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::insert([
            [
                'name' => 'OMAR HASSAN',
                'email' => 'omar.booking@clinic.com',
                'phone' => '01000000001',
                'doctor_id' => 1,
                'user_id' => 13,
                'booking_date' => now()->addDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SALMA AHMED',
                'email' => 'salma.booking@clinic.com',
                'phone' => '01000000002',
                'doctor_id' => 2,
                'user_id' => 14,
                'booking_date' => now()->addDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MOHAMED ALI',
                'email' => 'mohamed.booking@clinic.com',
                'phone' => '01000000003',
                'doctor_id' => 3,
                'user_id' => 15,
                'booking_date' => now()->addDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FATMA HANY',
                'email' => 'fatma.booking@clinic.com',
                'phone' => '01000000004',
                'doctor_id' => 4,
                'user_id' => 16,
                'booking_date' => now()->addDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AHMED KHALED',
                'email' => 'ahmed.booking@clinic.com',
                'phone' => '01000000005',
                'doctor_id' => 5,
                'user_id' => 17,
                'booking_date' => now()->addDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NOURHAN TAREK',
                'email' => 'nourhan.booking@clinic.com',
                'phone' => '01000000006',
                'doctor_id' => 6,
                'user_id' => 18,
                'booking_date' => now()->addDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'YASSER HOSNY',
                'email' => 'yasser.booking@clinic.com',
                'phone' => '01000000007',
                'doctor_id' => 7,
                'user_id' => 19,
                'booking_date' => now()->addDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MARIAM SAMIR',
                'email' => 'mariam.booking@clinic.com',
                'phone' => '01000000008',
                'doctor_id' => 8,
                'user_id' => 20,
                'booking_date' => now()->addDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HANY REDA',
                'email' => 'hany.booking@clinic.com',
                'phone' => '01000000009',
                'doctor_id' => 9,
                'user_id' => 21,
                'booking_date' => now()->addDays(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DINA ASHRAF',
                'email' => 'dina.booking@clinic.com',
                'phone' => '01000000010',
                'doctor_id' => 10,
                'user_id' => 22,
                'booking_date' => now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SAMIR LOTFY',
                'email' => 'samir.booking@clinic.com',
                'phone' => '01000000011',
                'doctor_id' => 11,
                'user_id' => 23,
                'booking_date' => now()->addDays(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LAILA MAGDY',
                'email' => 'laila.booking@clinic.com',
                'phone' => '01000000012',
                'doctor_id' => 12,
                'user_id' => 24,
                'booking_date' => now()->addDays(12),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
