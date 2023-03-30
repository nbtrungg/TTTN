<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\EmployeServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employe\EmployeRequest;
use App\Http\Requests\Employe\EditRequest;
use Illuminate\Http\Request;
use App\Models\Employe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AddEmployeController extends Controller
{
    
    protected $employeServices;

    public function __construct(EmployeServices $employeServices)
    {
        $this->employeServices=$employeServices;
    }
    
    public function userCan($action, $option = NULL){
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    public function create(){
        if (!$this->userCan('view-page-admin')) {

            // abort('403', __('Bạn không có quyền thực hiện thao tác này'));
            return redirect()->back()->with('qtv','Chỉ QTV mới có thể vào trang này!');
      
        }
        $user = Auth::user();
        return view('pages.addemploye',compact('user'),['title'=>'Thêm Nhân Viên']);
    }

    public function store(EmployeRequest $request){
        if (!$this->userCan('view-page-admin')) {

            // abort('403', __('Bạn không có quyền thực hiện thao tác này'));
            return redirect()->back()->with('qtv','Chỉ QTV mới có thể vào trang này!');
      
        }
        $result=$this->employeServices->create($request);
            return redirect()->route('listemploye');
        // dd($request->input());
    }
    public function product(){
        if (!$this->userCan('view-page-admin')) {
            // abort('403', __('Bạn không có quyền thực hiện thao tác này'));
            return redirect()->back()->with('qtv','Chỉ QTV mới có thể vào trang này!');
        }
        $usermaps=DB::table('users')->orderBy('id', 'DESC')->get();
        $user = Auth::user();
        // dd(request()->key);
        $users=$this->employeServices->list();
        // $users=DB::select('SELECT * FROM users ORDER BY id DESC');
        // $users=DB::table('users')->Paginate(3);
        return view('pages.listemploye',compact('users','user','usermaps'),['title'=>'Danh Sách Nhân Viên']);
    }
    public function getEdit($id=0){
        if (!$this->userCan('view-page-admin')) {

            // abort('403', __('Bạn không có quyền thực hiện thao tác này'));
            return redirect()->back()->with('qtv','Chỉ QTV mới có thể vào trang này!');
      
        }
        $user = Auth::user();
        if(!empty($id)){
            $edit=$this->employeServices->edit($id);
        }
        else{
            return redirect()->route('listemploye')->with('error','Liên kết không tồn tại!');
        }
        
        return view('pages.editemploye',compact('edit','user'),['title'=>'Cập Nhật Nhân Viên']);
    }
    public function postEdit(EditRequest $editrequest,$id=0){
        if (!$this->userCan('view-page-admin')) {

            // abort('403', __('Bạn không có quyền thực hiện thao tác này'));
            return redirect()->back()->with('qtv','Chỉ QTV mới có thể vào trang này!');
      
        }
        $result=$this->employeServices->update($editrequest,$id);
        return redirect()->route('listemploye');
    }

    public function getDelete($id=0){
        if (!$this->userCan('view-page-admin')) {

            // abort('403', __('Bạn không có quyền thực hiện thao tác này'));
            return redirect()->back()->with('qtv','Chỉ QTV mới có thể vào trang này!');
      
        }
        if(!empty ($id)){
            $this->employeServices->delete($id);
            return redirect()->route('listemploye');
        }
        else{
            return redirect()->route('listemploye')->with('error','Liên kết không tồn tại!');
        }

    }
}
