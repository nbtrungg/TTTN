<?php

namespace App\Http\Services;

use App\Models\Employe;
use App\Models\Customer;
use App\Models\CustomerMail;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\DB;

class CustomerServices{
    public function id_employe(){
        return DB::table('users')->get();
    }

    public function store($request){
        try{
            $id = Customer::insertGetId([
                'employe_id'=>(int)$request->input('employe_id'),
                'customer_name'=>(string)$request->input('name'),
                'phone'=>(string)$request->input('phone'),
                'status'=>(int)$request->input('status'),
                'address'=>(string)$request->input('address'),
            ]);
            
                CustomerMail::create([
                    'customer_id'=>$id,
                    'mail'=>(string)$request->input('email'),
                ]);
            FacadesSession::flash('success','Thêm thành công!');
            
        }
        catch (\Exception $err){
            FacadesSession::flash('error','Thêm không thành công!');
            return false;
            
        }
    }

    public function list(){
        // return DB::table('customer')->join('customer_mail', 'customer.id', '=', 'customer_mail.customer_id')->get('customer_mail.mail');
        // DB::table('customer')->join('customer_mail', 'customer.id', '=', 'customer_mail.customer_id')->get('customer_mail.mail');
        return DB::table('customer')->orderBy('id', 'DESC')->get();
    }

    public function mail(){
        return DB::table('customer_mail')->get();
    }
    
    public function postemail($request){
        if((int)$request->input('customer_id')==0){
            FacadesSession::flash('error','Bạn chưa chọn khách hàng');
        }else{
            try{
                CustomerMail::create([
                    'customer_id'=>(int)$request->input('customer_id'),
                    'mail'=>(string)$request->input('addemail'),
                    ]);
                    FacadesSession::flash('success','Thêm thành công!');
                    
                }
                catch (\Exception $err){
                    FacadesSession::flash('error','Thêm không thành công!');
                    return false;
                    
                }
        }
        
    }
    
    public function deletechecked($request){
         $ids=$request->id;
         DB::table('customer')->whereIn('id',$ids)->delete();
         DB::table('customer_mail')->whereIn('customer_id',$ids)->delete();
         FacadesSession::flash('success','Xóa thành công!');
        }
        
        public function editcustomer($id){
            return DB::table('customer')->where('id',$id)->get();
            // return DB::table('customer')->get();
        }

        public function editcustomer_mail($id){
            return DB::table('customer_mail')->where('customer_id',$id)->get();
            // return DB::table('customer')->get();
        }

        public function customer($id){
            return DB::table('customer')->where('id',$id)->get();
        }
        
        public function update($request){
            $id=(int)$request->input('mail_id');
            if($id==0){
                FacadesSession::flash('error','bạn chưa chọn email cần cập nhật');
            }else{
                try{
                    $update = DB::table('customer_mail')->where('id', $id)->update([
                        'mail'=>(string)$request->input('updatemail'),
                ]);
                    FacadesSession::flash('success','cập nhật thành công');
                    
                }
                catch (\Exception $err){
                    FacadesSession::flash('error','Thêm không thành công!');
                    return false;
                    
                }
                return true;
            }
            
        }
        public function delete_email($id){
        //     $email = DB::table('customer_mail')->where('id',$id)->get();
        // if($email[0]->id==0){
        //     FacadesSession::flash('error','Liên kết không tồn tại');
        // }
        // else{
            FacadesSession::flash('success','Xóa Email thành công');
            return DB::table('customer_mail')->where('id',$id)->delete();
        // }
        }

        public function delete_1($id){
            
            FacadesSession::flash('success','Xóa thành công!');
            DB::table('customer')->where('id',$id)->delete();
            DB::table('customer_mail')->where('customer_id',$id)->delete();
            }

        public function edit_customer($id){
            $data=DB::table('customer')->where('id',$id)->get();
            if(!empty($data[0])){
                $data=$data[0];
            }else{
                // FacadesSession::flash('error','Khách hàng không tồn tại');
                return redirect()->route('listcustomer');
                // ->with('error','Người dùng không tồn tại!');
            }
        return $data;
        }

        public function update_customer($editCustomerRequest,$id){
            try{
                $update = DB::table('customer')->where('id', $id)->update([
                'customer_name'=>(string)$editCustomerRequest->input('name'),
                'phone'=>(string)$editCustomerRequest->input('phone'),
                'status'=>(int)$editCustomerRequest->input('status'),
                'address'=>(string)$editCustomerRequest->input('address'),
            ]);
                FacadesSession::flash('success','cập nhật thành công');
                
            }
            catch (\Exception $err){
                FacadesSession::flash('error','cập nhật thất bại');
                return false;
                
            }
            return true;
        }
    }