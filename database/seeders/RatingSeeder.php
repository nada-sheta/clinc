<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        Rating::insert([
            [
                'user_id' => 13,
                'doctor_id' => 1,
                'rating' => 5,
                'comment' => 'Excellent doctor, very helpful and kind.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 14 (SALMA AHMED), doctor_id => 2 (Dr.MOSTAFA)
            [
                'user_id' => 14,
                'doctor_id' => 2,
                'rating' => 4,
                'comment' => 'Very knowledgeable and explained everything clearly.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 15 (MOHAMED ALI), doctor_id => 3 (Dr.NOAH)
            [
                'user_id' => 15,
                'doctor_id' => 3,
                'rating' => 5,
                'comment' => 'Great experience, highly recommend.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 16 (FATMA HANY), doctor_id => 4 (Dr.HEND)
            [
                'user_id' => 16,
                'doctor_id' => 4,
                'rating' => 4,
                'comment' => 'Very friendly and professional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 17 (AHMED KHALED), doctor_id => 5 (Dr.EDWARD)
            [
                'user_id' => 17,
                'doctor_id' => 5,
                'rating' => 5,
                'comment' => 'Solved my issue quickly and effectively.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 18 (NOURHAN TAREK), doctor_id => 6 (Dr.CHARLES)
            [
                'user_id' => 18,
                'doctor_id' => 6,
                'rating' => 4,
                'comment' => 'Great consultation and advice.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 19 (YASSER HOSNY), doctor_id => 7 (Dr.JASMINE)
            [
                'user_id' => 19,
                'doctor_id' => 7,
                'rating' => 5,
                'comment' => 'Very caring and supportive.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 20 (MARIAM SAMIR), doctor_id => 8 (Dr.FARAH)
            [
                'user_id' => 20,
                'doctor_id' => 8,
                'rating' => 4,
                'comment' => 'Listened carefully and provided great advice.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 21 (HANY REDA), doctor_id => 9 (Dr.NADA)
            [
                'user_id' => 21,
                'doctor_id' => 9,
                'rating' => 5,
                'comment' => 'Very good doctor with excellent follow-up.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 22 (DINA ASHRAF), doctor_id => 10 (Dr.REDA)
            [
                'user_id' => 22,
                'doctor_id' => 10,
                'rating' => 4,
                'comment' => 'Professional and quick diagnosis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 23 (SAMIR LOTFY), doctor_id => 11 (Dr.TAMER)
            [
                'user_id' => 23,
                'doctor_id' => 11,
                'rating' => 5,
                'comment' => 'Friendly, caring, and thorough.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user_id => 24 (LAILA MAGDY), doctor_id => 12 (Dr.JOSEPH)
            [
                'user_id' => 24,
                'doctor_id' => 12,
                'rating' => 4,
                'comment' => 'Very polite and professional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
