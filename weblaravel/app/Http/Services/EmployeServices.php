<?php

namespace App\Http\Services;

use App\Models\Employe;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class EmployeServices{
    // public function getEmploye(){
    //     return Employe::where('active',1)->get();
    // }
    protected function cfPassword($request){
        if($request->input('password')!=$request->input('confirm_password')){
            FacadesSession::flash('error','Password không trùng khớp!');
            return false;
        }
        return true;
    }
    public function create($request){
        $cfPassword=$this->cfPassword($request);
        if($cfPassword==false){
            return false;
        }
        try{
            // DB::table('users')->insert([
            //     'name'=>(string)$request->input('name'),
            //     'avatar'=>(string)$request->input('file'),
            //     'phone'=>(int)$request->input('phone'),
            //     'email'=>(string)$request->input('email'),
            //     // 'status'=>(string)$request->input('fullname'),
            //     'address'=>(string)$request->input('address'),
            //     'password'=>(string)bcrypt($request->input('password')),
            //     'roll'=>(int)$request->input('roll'),
            // ]);
            Employe::create([
                
                'name'=>(string)$request->input('name'),
                'avatar'=>(string)$request->input('file'),
                'phone'=>(string)$request->input('phone'),
                'email'=>(string)$request->input('email'),
                // 'status'=>(string)$request->input('fullname'),
                'address'=>(string)$request->input('address'),
                'password'=>(string)bcrypt($request->input('password')),
                'roll'=>(int)$request->input('roll'),
            ]);
            FacadesSession::flash('success','Thêm thành công!');
            
        }
        catch (\Exception $err){
            FacadesSession::flash('error',$err->getMessage());
            return false;
            
        }
        return true;
    }
    public function list(){
    //    return DB::select('SELECT * FROM users ORDER BY id DESC');
           return DB::table('users')->orderBy('id', 'DESC')->get();

    }   

    public function edit($id){
        $data=DB::table('users')->where('id',$id)->get();
            if(!empty($data[0])){
                $data=$data[0];
            }else{
                // FacadesSession::flash('error','Nhân viên không tồn tại');
                return redirect()->route('listemploye');
                // ->with('error','Người dùng không tồn tại!');
            }
        return $data;
        
    }
    public function update($editrequest,$id){
        
        // $cfPassword=$this->cfPassword($request);
        // if($cfPassword==false){
        //     return false;
        // }
        try{
            $update = DB::table('users')->where('id', $id)->update([
                'name'=>(string)$editrequest->input('name'),
                'avatar'=>(string)$editrequest->input('file'),
                'phone'=>(string)$editrequest->input('phone'),
                'email'=>(string)$editrequest->input('email'),
                // 'status'=>(string)$request->input('fullname'),
                'address'=>(string)$editrequest->input('address'),
                // 'password'=>(string)bcrypt($request->input('password')),
                'roll'=>(int)$editrequest->input('roll'),
        ]);
            FacadesSession::flash('success','cập nhật thành công');
            
        }
        catch (\Exception $err){
            FacadesSession::flash('error','cập nhật thất bại');
            return false;
            
        }
        return true;
    }

    public function delete($id){
        $user = Auth::user();
        $employe = DB::table('users')->where('id',$id)->get();
        if((string)$employe[0]->email==(string)$user->email){
            FacadesSession::flash('error','Không thể xóa chính mình');
        }
        else if((int)$employe[0]->roll==0){
            FacadesSession::flash('error','Không thể xóa QTV');
        }
        else{
            FacadesSession::flash('success','Xóa thành công');
            return DB::table('users')->where('id',$id)->delete();
        }
    }

    
}