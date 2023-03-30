<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    // protected $mainController;

    // public function __construct(MainController $mainController)
    // {
    //     $this->mainController=$mainController;
    // }
        
    public function login(){
        return view('admin.users.login');
    }

    public function home(Request $request){
        $this->validate($request,[
            'email'=>'required|email:filter',
            'pass'=>'required',
            'g-recaptcha-response' => 'required|captcha'
        ],
        [
            'email.required'=>'Vui lòng nhập Email',
            'pass.required'=>'Vui lòng nhập mật khẩu',
            'g-recaptcha-response.required'=>'Vui lòng xác nhận capcha',
        ]
    );
        

        if (Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('pass'),
            // 'roll'=>0,
        ],$request->input('remember'))) {
            // $email=(string)$request->input('email');
            // $this->mainController->admin($email);
            $user = Auth::user();
            DB::table('users')->where('id',$user->id)->update(['status'=>'0']);
            return redirect()-> route('admin');
        }
        
        session()->flash('error','Email hoặc Password không đúng!');
        return redirect()->back();
    }
    // public function logout(){
    //     if(auth::logout()){
    //         $user = Auth::user();
    //         DB::table('users')->where('id',$user->id)->update(['status'=>'1']);
    //         return redirect('admin/users/login');
    //     }
    //     return redirect()->back();
    // }

    public function logout(){
        $user = Auth::user();
        DB::table('users')->where('id',$user->id)->update(['status'=>'1']);
        if(auth::logout()){
            return redirect('admin/users/login');
        }
        return redirect()->back();
    }
}
