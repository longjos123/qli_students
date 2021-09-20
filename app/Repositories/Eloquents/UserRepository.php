<?php

namespace App\Repositories\Eloquents;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Point;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(){
        $__ROLE_STUDENT = 0;
        return User::where('role','=',$__ROLE_STUDENT)->get();
    }
    public function find($id){
        return User::findOrFail($id);
    }
    public function editInfo($student,$request){
        try{
            $student->fill($request->all());
            $student->save();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function delete($id){
       try{
            Point::where('id_user', $id)->delete(); //Xóa điểm trong bảng point
            User::destroy($id); //Xóa user trong bảng users
       }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function add($request){
        try{
            $pin = mt_rand(100, 9999).mt_rand(0, 99); //lấy mã số rand để gán vào user_code
            $newUser = [
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
            $idNewUser = $newUser['id']; //lấy id new_user
            User::create($newUser);
            return $idNewUser;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}