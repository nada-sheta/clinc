<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Askcontroller;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ProfileDoctorController;
use App\Http\Controllers\Api\ProfileUserController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DoctorRequestsController;
use App\Http\Controllers\Api\Mail\Mailcontroller;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\Schedulecontroller;

// Route::delete('/booking/{booking}',[ProfileUserController::class,'destroy'])->name('booking.destroy');
// Route::delete('/bookings/doctor/{booking}',[ProfileDoctorController::class,'destroy'])->name('booking.doctor.destroy');
// Route::post('/doctors/booking/{doctorId}', [DoctorController::class, 'store'])->name('doctors.store');

Route::get('/majors',[MajorController::class,'index']);
Route::get('/doctors',[DoctorController::class,'index']);
Route::get('/majors/{majorId}',[MajorController::class,'show']);
Route::post('/doctor/application/form', [DoctorRequestsController::class, 'store']);
Route::post('/chat/send', [Askcontroller::class, 'sendMessage']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile/doctor',[ProfileDoctorController::class,'profile_doctor']);
    Route::get('/profile/user',[ProfileUserController::class,'profile_user']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::post('/major', [MajorController::class, 'store']);
    Route::delete('/majors/{major}',[MajorController::class,'destroy']);
    Route::put('/majors/{major}',[MajorController::class,'update']); 
    Route::delete('/doctors/{doctor}',[DoctorController::class,'destroy']);
    Route::put('/doctors/{doctor}',[DoctorController::class,'update']);
    Route::post('/add/admin', [DashboardController::class, 'store']);
    Route::get('/doctor/requests', [DoctorRequestsController::class, 'show']);
    Route::delete('/doctors/request/{id}',[DoctorRequestsController::class,'destroy']);
    Route::post('/doctor', [DoctorController::class, 'store']);
    Route::post('accept-email/{id}', [Mailcontroller::class, 'send_accept']);
    Route::put('/user/update', [ProfileUserController::class, 'update']);
    Route::put('/update/account/doctor', [ProfileDoctorController::class, 'update_account']);
    Route::put('/update/data/sie/doctor', [ProfileDoctorController::class, 'update_data']);
    Route::post('/manage/schedule',[Schedulecontroller::class,'store']);
    Route::delete('/destroy/schedule/{slot}',[ScheduleController::class,'destroy']);
    Route::get('/schedules',[ScheduleController::class,'show']);
    Route::get('/show/ratings',[RatingController::class,'show_rating']);
    Route::delete('/destroy/rate/{rate}',[RatingController::class,'destroy_rate']);
    Route::post('/store/rate/{doctor}',[RatingController::class,'store_rate']);
    Route::get('/show/booking/{doctorId}', [BookingController::class, 'show']);
});
    
    

