<?php

namespace App\Http\Controllers;

use App\Models\Frequently;
use App\Models\Teacher;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function dashboard(){
        $frequently = Frequently::get();
        $teachers = Teacher::get();
        return view('admin.content')->with(['frequentlies'=>$frequently, 'teachers'=>$teachers]);
    }
   
    
}
