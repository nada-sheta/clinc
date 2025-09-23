<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable =[
        'name',
        'phone',
        'doctor_id',
        'user_id',
        'booking_date',
        'email'
        ];
        // علشان booking_date يتعامل كـ Carbon
    protected $casts = [
        'booking_date' => 'datetime',
    ];
    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }     
}
