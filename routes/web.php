<?php

use App\Http\Controllers\AuthGoogle\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MajorController;
use App\Http\Controllers\Site\DoctorController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\LogoutController;
use App\Http\Controllers\Site\RegisterController;
use App\Http\Controllers\Site\DoctorApplicationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AdminMajorController;
use App\Http\Controllers\Dashboard\AdminDoctorController;
use App\Http\Controllers\Dashboard\AdminLoginController;
use App\Http\Controllers\Dashboard\DoctorRequestsController;
use App\Http\Controllers\Mails\MailController;
use App\Http\Controllers\Site\AskController;
use App\Http\Controllers\Site\PasswordResetLinkController;
use App\Http\Controllers\Site\ProfileUserController;
use App\Http\Controllers\Site\ProfileDoctorController;
use App\Http\Controllers\Site\ScheduleController;

Route::get('/',[HomeController::class,'index'])->name('site.home');
Route::get('forgot-password', [PasswordResetLinkController::class, 'show'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetLinkController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [PasswordResetLinkController::class, 'updatePassword'])->name('password.update');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// SITE
Route::prefix('CLINC')->group(function(){
    Route::middleware('auth:web')->group(function(){
        Route::get('/doctors/{doctorId}',[DoctorController::class,'show'])->name('doctors.show');
        Route::post('/doctors/booking/{doctorId}', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('/profile/user',[ProfileUserController::class,'profile_user'])->name('profile.user');
        Route::get('/profile/doctor',[ProfileDoctorController::class,'profile_doctor'])->name('profile.doctor');
        Route::delete('/booking/{booking}',[ProfileUserController::class,'destroy'])->name('booking.destroy');
        Route::get('/user/{user}/edit-name',[ProfileUserController::class,'edit_name'])->name('user.edit.name');
        Route::get('/user/{user}/edit-password',[ProfileUserController::class,'edit_password'])->name('user.edit.password');
        Route::get('/user/{user}/edit-email',[ProfileUserController::class,'edit_email'])->name('user.edit.email');
        Route::get('/user/{user}/edit-image',[ProfileUserController::class,'edit_image'])->name('user.edit.image');
        Route::put('/user/{user}/update-name',[ProfileUserController::class,'update_name'])->name('user.update.name');
        Route::put('/user/{user}/update-email',[ProfileUserController::class,'update_email'])->name('user.update.email');
        Route::put('/user/{user}/update-password',[ProfileUserController::class,'update_password'])->name('user.update.password');
        Route::put('/user/{user}/update-image',[ProfileUserController::class,'update_image'])->name('user.update.image');
        Route::delete('/bookings/doctor/{booking}',[ProfileDoctorController::class,'destroy'])->name('booking.doctor.destroy');
        Route::get('/doctor/{doctor}/edit',[ProfileDoctorController::class,'edit'])->name('doctor.edit');
        Route::get('/doctor/edit',[ProfileDoctorController::class,'edit_info'])->name('doctor.edit.info');
        Route::put('/doctor/{doctor}',[ProfileDoctorController::class,'update'])->name('doctor.update');
        Route::put('/doctor',[ProfileDoctorController::class,'updateDoctorInfo'])->name('doctor.updateInfo');
        Route::get('/rate/doctor/{doctorId}',[DoctorController::class,'show_rate'])->name('rate.doctor');
        Route::post('/rate/doctor/{doctorId}',[DoctorController::class,'store_rate'])->name('rate.store');
        Route::get('/doctor/rating/{doctorId}',[ProfileDoctorController::class,'show_rating'])->name('show.rating');
        Route::get('/manage/schedule/{doctorId}',[ScheduleController::class,'show'])->name('show.schedule');
        Route::post('/manage/schedule/{doctorId}',[ScheduleController::class,'store'])->name('store.schedule');
        Route::delete('/destroy/schedule/{slot}',[ScheduleController::class,'destroy'])->name('doctor.schedule.destroy');
        Route::delete('/destroy/rate/{rate}',[ProfileDoctorController::class,'destroy_rate'])->name('rate.destroy');
    });
    Route::get('/majors',[MajorController::class,'index'])->name('site.majors');
    Route::get('/doctors',[DoctorController::class,'index'])->name('site.doctors');
    Route::get('/majors/{majorId}',[MajorController::class,'show'])->name('majors.show');
    Route::get('/doctor/application/form', [DoctorApplicationController::class, 'show'])->name('doctor.application.show');
    Route::post('/doctor/application/form', [DoctorApplicationController::class, 'store'])->name('doctor.application.store');
    Route::get('/show/chat',[AskController::class,'show'])->name('show.chat');
    Route::post('/ask/send', [AskController::class, 'sendMessage'])->name('ask.send');
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
    Route::post('/logout', LogoutController::class)->name('logout');
});

// ADMIN
Route::prefix('dashboard')->as('dashboard.')->group(function () {
    Route::middleware('auth:admin')->group(function(){
        Route::get('/home', [DashboardController::class, 'index'])->name('home');
        Route::get('/majors', [AdminMajorController::class, 'index'])->name('majors');
        Route::get('/majors/create', [AdminMajorController::class, 'create'])->name('majors.create');
        Route::post('/majors', [AdminMajorController::class, 'store'])->name('majors.store');
        Route::get('/majors/{majorId}',[AdminMajorController::class,'show'])->name('majors.show');
        Route::delete('/majors/{major}',[AdminMajorController::class,'destroy'])->name('majors.destroy');
        Route::get('/majors/{major}/edit',[AdminMajorController::class,'edit'])->name('majors.edit');
        Route::put('/majors/{major}',[AdminMajorController::class,'update'])->name('majors.update');    
        Route::get('/doctors',[AdminDoctorController::class,'index'])->name('doctors');
        Route::get('/doctors/create/{id?}', [AdminDoctorController::class, 'create'])->name('doctors.create');
        Route::post('/doctors/{id?}', [AdminDoctorController::class, 'store'])->name('doctors.store');
        Route::delete('/doctors/{doctor}',[AdminDoctorController::class,'destroy'])->name('doctors.destroy');
        Route::get('/doctors/{doctor}/edit',[AdminDoctorController::class,'edit'])->name('doctors.edit');
        Route::put('/doctors/{doctor}',[AdminDoctorController::class,'update'])->name('doctors.update');
        Route::get('/add/admin', [DashboardController::class, 'create'])->name('admins.create');
        Route::post('/add/admin', [DashboardController::class, 'store'])->name('admins.store');
        Route::get('/doctor/requests', [DoctorRequestsController::class, 'show'])->name('doctor.requests.show');
        Route::get('/accept/edit/mail', [MailController::class, 'edit_mail'])->name('edit.mail');
        Route::post('/accept/mail/{id}', [MailController::class, 'send_accept'])->name('send.mail.accept');
        Route::delete('/doctors/request/{request}',[DashboardController::class,'destroy'])->name('doctor.request.destroy');
    }); 
    Route::get('/login', [AdminLoginController::class, 'show'])->name('login.show');
    Route::post('/login', [AdminLoginController::class, 'auth'])->name('login.auth');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/logout', function () { abort(404); });
});