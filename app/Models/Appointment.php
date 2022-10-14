<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['name','email','date','appointment','phone','message','user_id','doctor_id'];
    public function user(){
        return $this->belongsTo(User::class);
     }
     public function doctor(){
        return $this->belongsTo(Doctor::class);
     }
}
