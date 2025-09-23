<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable =[
        'name',
        'image',
        'major_id',
        'account_doctor',
        'booking_price',
        'description'
        ];
    public function major(){
        return $this->belongsTo(Major::class, 'major_id','id');
    }
    public function bookings(){
    return $this->hasMany(Booking::class, 'doctor_id','id');
    }
    public function user(){
    return $this->belongsTo(User::class, 'account_doctor','id');
    }
    public function ratings(){
    return $this->hasMany(Rating::class, 'doctor_id','id');
    }
    public function schedule(){
    return $this->hasMany(DoctorSchedule::class, 'doctor_id','id');
    }
}
