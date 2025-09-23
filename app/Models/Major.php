<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = 'majors';
    protected $fillable = [
        'name',
        'image'
    ];
    public function doctors(){
    return $this->hasMany(Doctor::class, 'major_id','id');
    }
}
