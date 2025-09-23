<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;
    protected $table = 'doctor_schedules';
    protected $fillable =[
        'doctor_id',
        'day_from',
        'day_to',
        'time_from',
        'time_to',
        'start_date',
    ];
    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id','id');
    }
}
