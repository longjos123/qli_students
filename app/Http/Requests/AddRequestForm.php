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
            'birth_date' =>'required|date_format:format',
            'age' => 'required|min:1|numeric',
            'address' => 'required',
            'hobby' => 'required',
            'id_class' => 'required',
            '1','2','3','4' => 'required|min:0|max:10|numeric'
        ];
    }
    public function massages(){
        return [
            'username.required' => 'Chưa nhập Username!!!',
            'username.unique' => 'Username đã tôn tại!',
            'password.required' => 'Chưa nhập password!!!',
            'fullname.required' => 'Chưa nhập tên!',
            'role.required' => 'Chưa chọn vai trò!',
            'gender.required' => 'Chưa chọn giới tính!',
            'birth_date.required' => 'Chưa nhập ngày sinh!',
            'birth_date.date_format' => 'Ngày sinh không đúng định dạng!',
            'age.required' => 'Chưa nhập tuổi!',
            'age.min' => 'Nhập sai định dạng tuổi!',
            'age.numeric' => 'Tuổi phải nhập số!',
            'address.required' => 'Chưa nhập địa chỉ!',
            'hobby.required' => 'Chưa nhập sở thích!',
            'id_class.required' => 'Chưa chọn lớp!',
            '1.required','2.required','3.required','4.required' => 'Nhập điểm!',
            '1.min','2.min','3.min','4.min' => 'Điểm phải lớn hơn hoặc bằng 0!',
            '1.max','2.max','3.max','4.max' => 'Điểm phải bé hơn hoặc bằng 10!',
            '1.numeric','2.numeric','3.numeric','4.numeric' => 'Nhập chưa đúng định dạng điểm!',
            
        ];
    }
}