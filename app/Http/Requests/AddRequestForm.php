<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddRequestForm extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'password' => 'required',
            'fullname' => 'required',
            'role' => 'required',
            'gender' => 'required',
            // 'birth_date' =>'required|date_format:dd/mm/yyyy',
            'age' => 'required|min:1|numeric',
            'address' => 'required',
            'hobby' => 'required',
            'id_class' => 'required',
        ];
    }
    public function massages()
    {
        return [
            'username.required' => 'Chưa nhập Username!!!',
            'username.unique' => 'Username đã tôn tại!',
            'password.required' => 'Chưa nhập password!!!',
            'fullname.required' => 'Chưa nhập tên!',
            'role.required' => 'Chưa chọn vai trò!',
            'gender.required' => 'Chưa chọn giới tính!',
            'birth_date.required' => 'Chưa nhập ngày sinh!',
            // 'birth_date.date_format' => 'Ngày sinh không đúng định dạng!',
            'age.required' => 'Chưa nhập tuổi!',
            'age.min' => 'Nhập sai định dạng tuổi!',
            'age.numeric' => 'Tuổi phải nhập số!',
            'address.required' => 'Chưa nhập địa chỉ!',
            'hobby.required' => 'Chưa nhập sở thích!',
            'id_class.required' => 'Chưa chọn lớp!',

        ];
    }
}