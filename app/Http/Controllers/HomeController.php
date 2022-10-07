<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

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
}
