<?php

namespace App\Repositories\Eloquents;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Point;

class UserRepository implements UserRepositoryInterface
{
    public function get_all(){
        $__ROLE_STUDENT = 0;
        return User::where('role','=',$__ROLE_STUDENT)->get();
    }
    public function find($id){
        return User::find($id);
    }
    public function editInfo($student,$request){
        $student->fill($request->all());
        $student->save();
    }
    public function delete($id){
        Point::where('id_user', $id)->delete(); //Xóa điểm trong bảng point
        User::destroy($id); //Xóa user trong bảng users
    }
    public function add($request){
        $pin = mt_rand(100, 9999).mt_rand(0, 99); //lấy mã số rand để gán vào user_code
        $new_user = [
            'id' => mt_rand(8, 1000000),
            'username' => $request->username,
            'fullname' => $request->fullname,
            'password' => Hash::make($request->password),
            'user_code' => str_shuffle($pin),
            'age' => $request->age,
            'address' => $request->address,
            'id_class' => $request->id_class,
            'hobby' =>$request->hobby,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'role' => $request->role
        ];
        $id_new_user = $new_user['id']; //lấy id new_user
        User::create($new_user);
        return $id_new_user;
    }
}