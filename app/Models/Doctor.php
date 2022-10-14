<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name','phone','room_no','specialty','profile_pic'];
    use HasFactory;
    public function appointment(){
        return $this->hasMany(Appointment::class);
     }
}
