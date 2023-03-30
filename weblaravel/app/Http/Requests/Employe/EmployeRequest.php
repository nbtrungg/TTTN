<?php

namespace App\Http\Requests\Employe;

use Illuminate\Foundation\Http\FormRequest;

class EmployeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'phone'=>'required|numeric|digits:10',
            'email'=>'required|email:filter,rfc,dns|unique:users',
            'address'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password',
            'file'=>'required',
            'roll'=>'required',

        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Vui lòng nhập tên',
            'phone.required'=>'Vui lòng nhập SĐT',
            'phone.numeric'=>'Vui lòng chỉ nhập số và nhập 10 số',
            'phone.digits'=>'Vui lòng chỉ nhập số và nhập 10 số',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại',
            'address.required'=>'Vui lòng nhập địa chỉ',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'confirm_password.required'=>'Vui lòng nhập lại mật khẩu',
            'confirm_password.same'=>'Mật khẩu không trùng khớp!',
            'file.required'=>'Vui lòng nhập ảnh',
            'roll.required'=>'Vui lòng chọn vai trò',
        ];
    }
}
