<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'addemail'=>'required|email:filter,rfc,dns',
        ];
    }

    public function messages()
    {
        return[
            'addemail.required'=>'Vui lòng nhập email',
            'addemail.email'=>'Email không đúng định dạng',
        ];
    }
}
