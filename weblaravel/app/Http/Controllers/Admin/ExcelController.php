<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\CustomerImport;
use App\Imports\UsersImport;
use App\Rules\ExcelImportRuleEmploye;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExcelController extends Controller
{
    public function exportEmploye() 
    {
        return Excel::download(new UsersExport, 'NhanVien.xlsx');
    }

    public function importEmploye(Request $request){
        Excel::import(new UsersImport,request()->file('file'));
        return redirect()->route('listemploye')->with('success', 'Thêm nhân viên thành công');
    }

    public function exportCustomer() 
    {
        return Excel::download(new CustomerExport, 'KhachHang.xlsx');
    }

    public function importCustomer(Request $request){
        Excel::import(new CustomerImport,request()->file('file'));
        return redirect()->route('listcustomer')->with('success', 'Thêm khách hàng thành công');
    }
}
