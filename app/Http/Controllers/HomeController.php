<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function Start(){
         return view("home.start");
     }

     public function About(){
         return view("home.about");
     }
}
