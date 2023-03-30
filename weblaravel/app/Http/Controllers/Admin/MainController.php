<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        $user = Auth::user();
        return redirect()->route('listcustomer');
    }

    // public function admin($email){
    //     $admin=DB::table('users')->where('email',$email)->get();
    //    return view('index',compact('admin'));
    // }
}
