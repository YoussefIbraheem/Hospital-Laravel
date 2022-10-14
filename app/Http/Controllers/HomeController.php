<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    
    $details = $request->validate([
      'name'=>'required|max:50',
      'email'=>'required|email|max:50',
      'phone'=>'required|max:50',
      'date'=>'required',
      'appointment'=>'required',
      'message'=>'max:200',
    ]);
    if($request->date < Carbon::now()){
      return redirect()->back()->withErrors('Appointment cannot be set to be in the past');
    }
    Appointment::create([
      'name'=>$request->name,
      'email'=>$request->email,
      'phone'=>$request->phone,
      'date'=>$request->date,
      'appointment'=>$request->appointment,
      'message'=>$request->message,
      'user_id'=>Auth::user()->id,
      'doctor_id'=>$request->doctor
    ]);
    session()->flash('addAppointment',"Appointment added successfully please expect an email on $request->email");

    return redirect()->back();


  }

  public function appointmentsList(){
    $user = Auth::user()->id;
    $userAppointments = Appointment::where('user_id',$user)->get();
    return view('user.appointments')->with(['userAppointments'=>$userAppointments]);
  }

  public function deleteAppointment($id){
    $appointmentDetails = Appointment::findOrFail($id);
    $appointmentDetails->delete();
    return redirect()->back();
  }

}
