<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   public function redirect(){
     if(Auth::id()){
        if(Auth::user()->access_type == 'admin'){
            return view('admin.home');
        }else{
            return view('user.home');
        }
     }
   }
}