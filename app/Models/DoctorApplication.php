<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorApplication extends Model
{
    use HasFactory;
    protected $table = 'doctor_applications';
    protected $fillable = [
        'name',
        'major',
        'email',
        'degree_certificate',
        'session_price',
        'phone',
    ];
}
