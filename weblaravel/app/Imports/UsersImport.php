<?php

namespace App\Imports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
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
    {
        return new Employe([
            'name'     => $row['ho_ten_nhan_vien'],
            'avatar'    => $row['anh_dai_dien'], 
            'phone'    => $row['sdt'], 
            'email'    => $row['email'], 
            'status'    => $row['trang_thai'], 
            'address'    => $row['dia_chi'], 
            'password' => bcrypt($row['password']),
            'roll'    => $row['vai_tro'], 

        ]);
    }
    public function rules(): array
    {
     return [
        //  '1' => Rule::in(['patrick@maatwebsite.nl']),
         // ngoài việc sử dụng số thứ tự các cột, bạn cũng có thể sử dụng tên cột để validate như sau: 
        //  'email' => 'required' //để sử dụng được tên cột, bạn cần implement thêm `WithHeadingRow` vào trong import class.
        'ho_ten_nhan_vien'=>'required',
        'anh_dai_dien'=>'required',
        'sdt'=>'required|numeric|digits:10',
        'email'=>'required|email:filter,rfc,dns|unique:users',
        'trang_thai'=>'required',
        'dia_chi'=>'required',
        'password'=>'required',
        'vai_tro'=>'required',
     ];
    }

    public function customValidationMessages()
    {
     return [
        'ho_ten_nhan_vien.required'=>'Họ Tên Nhân Viên: Vui lòng nhập tên',
        'sdt.required'=>'SĐT: Vui lòng nhập SĐT',
        'sdt.numeric'=>'SĐT: Vui lòng chỉ nhập số và nhập 10 số',
        'sdt.digits'=>'SĐT: Vui lòng chỉ nhập số và nhập 10 số',
        'email.required'=>'Email: Vui lòng nhập email',
        'email.email'=>'Email: Email không đúng định dạng',
        'email.unique'=>'Email: Email đã tồn tại',
        'dia_chi.required'=>'Địa Chỉ: Vui lòng nhập địa chỉ',
        'password.required'=>'Password: Vui lòng nhập mật khẩu',
        'trang_thai.required'=>'Trạng Thái: Vui lòng nhập lại mật khẩu',
        'anh_dai_dien.required'=>'Ảnh Đại Diện: Vui lòng nhập ảnh',
        'vai_tro.required'=>'Vai Trò: Vui lòng chọn vai trò',
     ];
    }
}