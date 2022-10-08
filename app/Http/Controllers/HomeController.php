<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    //  HOME PAGE METHODS
    public function index(){
      if(Auth::id()){
        return redirect(url('/home'));
      }else{
        return view('user.home');
      }
    }
  
     public function redirect(){
       if(Auth::id()){
          if(Auth::user()->access_type == 'admin'){
              return view('admin.home')->with(['user'=>Auth::user()]);
          }else{
              return view('user.home')->with(['user'=>Auth::user()]);
          }
       }
     }

  // APPOINTMENT METHODS
  public function bookAppointment( Request $request){
    $appointmentsList = ['9:00AM : 12:00PM','12:00PM : 3:00PM','3:00PM : 6:00PM','6:00PM : 9:00PM','9:00PM : 11:00PM'];

    $user = Auth::user();

    $details = $request->validate([
      'name'=>'required|max:50',
      'email'=>'required|email|max:50',
      'phone'=>'required|max:50',
      'date'=>'required',
      'appointment'=>'required',
      'doctor'=>'required',
      'message'=>'required|max:100'
    ]);

    Appointment::create($details);
    session()->flash('addAppointment',"Appointment added successfully please expect an email on $user->email");

    return redirect()->back();


  }

}
