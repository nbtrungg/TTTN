<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\CustomerMail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CustomerImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;
    public function headingRow() : int
    {
        return 1;
    }

    public function model(array $row)
    {   $user = Auth::user();
        $customer= Customer::create([
            'employe_id'=>$user->id,
            'customer_name'=> $row['ten_khach_hang'],
            'address'=> $row['dia_chi'],
            'phone'=> $row['sdt'],
            // 'email'=> $row['email'], 
            'status'=> $row['trang_thai'],
        ]);

        $emails = explode('#', $row['email']);
        
        foreach ($emails as $email) {
            CustomerMail::create([
                'customer_id' => $customer->id,
                'mail' => trim($email),
            ]);
        }
        return $customer;
    }
    public function rules(): array
    {
     return [
        //  '1' => Rule::in(['patrick@maatwebsite.nl']),
         // ngoài việc sử dụng số thứ tự các cột, bạn cũng có thể sử dụng tên cột để validate như sau: 
        //  'email' => 'required' //để sử dụng được tên cột, bạn cần implement thêm `WithHeadingRow` vào trong import class.
        'ten_khach_hang'=>'required',
        'sdt'=>'required|numeric|digits:10',
        'email'=>'required',
        'trang_thai'=>'required',
        'dia_chi'=>'required',
        
        
     ];
    }

    public function customValidationMessages()
    {
     return [
        'ten_khach_hang.required'=>'Tên Khách Hàng: Vui lòng nhập tên',
        'sdt.required'=>'SĐT: Vui lòng nhập SĐT',
        'sdt.numeric'=>'SĐT: Vui lòng chỉ nhập số và nhập 10 số',
        'sdt.digits'=>'SĐT: Vui lòng chỉ nhập số và nhập 10 số',
        'email.required'=>'Email: Vui lòng nhập email',
        'email.email'=>'Email: Email không đúng định dạng',
        'email.unique'=>'Email: Email đã tồn tại',
        'dia_chi.required'=>'Địa Chỉ: Vui lòng nhập địa chỉ',
        'trang_thai.required'=>'Trạng Thái: Vui lòng nhập lại mật khẩu',
     ];
    }
}
