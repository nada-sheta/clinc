<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DoctorSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DoctorSchedule::insert([
            [
                'doctor_id'  => 1,
                'day_from'   => 'saturday',
                'day_to'     => 'wednesday',
                'time_from'  => '09:00',
                'time_to'    => '13:00',
                'start_date' => Carbon::now()->addDays(1)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.MOSTAFA (doctor_id = 2)
            [
                'doctor_id'  => 2,
                'day_from'   => 'monday',
                'day_to'     => 'tuesday',
                'time_from'  => '10:00',
                'time_to'    => '15:00',
                'start_date' => Carbon::now()->addDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.NOAH (doctor_id = 3)
            [
                'doctor_id'  => 3,
                'day_from'   => 'thursday',
                'day_to'     => 'friday',
                'time_from'  => '14:00',
                'time_to'    => '18:00',
                'start_date' => Carbon::now()->addDays(4)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.HEND (doctor_id = 4)
            [
                'doctor_id'  => 4,
                'day_from'   => 'sunday',
                'day_to'     => 'tuesday',
                'time_from'  => '08:30',
                'time_to'    => '12:30',
                'start_date' => Carbon::now()->addDays(1)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.EDWARD (doctor_id = 5)
            [
                'doctor_id'  => 5,
                'day_from'   => 'monday',
                'day_to'     => 'wednesday',
                'time_from'  => '09:00',
                'time_to'    => '11:00',
                'start_date' => Carbon::now()->addDays(5)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.CHARLES (doctor_id = 6)
            [
                'doctor_id'  => 6,
                'day_from'   => 'tuesday',
                'day_to'     => 'wednesday',
                'time_from'  => '11:00',
                'time_to'    => '15:00',
                'start_date' => Carbon::now()->addDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.JASMINE (doctor_id = 7)
            [
                'doctor_id'  => 7,
                'day_from'   => 'friday',
                'day_to'     => 'wednesday',
                'time_from'  => '15:00',
                'time_to'    => '19:00',
                'start_date' => Carbon::now()->addDays(6)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.FARAH (doctor_id = 8)
            [
                'doctor_id'  => 8,
                'day_from'   => 'saturday',
                'day_to'     => 'monday',
                'time_from'  => '10:30',
                'time_to'    => '14:30',
                'start_date' => Carbon::now()->addDays(3)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.NADA (doctor_id = 9)
            [
                'doctor_id'  => 9,
                'day_from'   => 'wednesday',
                'day_to'     => 'monday',
                'time_from'  => '12:00',
                'time_to'    => '16:00',
                'start_date' => Carbon::now()->addDays(4)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.REDA (doctor_id = 10)
            [
                'doctor_id'  => 10,
                'day_from'   => 'monday',
                'day_to'     => 'tuesday',
                'time_from'  => '09:30',
                'time_to'    => '13:30',
                'start_date' => Carbon::now()->addDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.TAMER (doctor_id = 11)
            [
                'doctor_id'  => 11,
                'day_from'   => 'thursday',
                'day_to'     => 'friday',
                'time_from'  => '16:00',
                'time_to'    => '20:00',
                'start_date' => Carbon::now()->addDays(3)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dr.JOSEPH (doctor_id = 12)
            [
                'doctor_id'  => 12,
                'day_from'   => 'sunday',
                'day_to'     => 'monday',
                'time_from'  => '10:00',
                'time_to'    => '14:00',
                'start_date' => Carbon::now()->addDays(1)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
