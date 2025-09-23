<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable =[
        'comment',
        'rating',
        'user_id',
        'doctor_id'
        ];
    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id','id');
    }
    public function user(){
    return $this->belongsTo(User::class, 'user_id','id');
    }
}
