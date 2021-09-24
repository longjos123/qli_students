<?php

namespace App\Service;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Eloquents\PointRepository;
use Illuminate\Support\Facades\Hash;
use Exception;


class UserService
{
    public function __construct(UserRepository $userRepository, PointRepository $pointRepository)
    {
        $this->userRepository = $userRepository;
        $this->pointRepository = $pointRepository;
    }

    public function all()
    {
        return $this->userRepository->getAll();
    }

    public function addUser(Request $request)
    {
        try {
            $pin = mt_rand(100, 9999) . mt_rand(0, 99); //lấy mã số rand để gán vào user_code
            $newUser = [
                'id' => mt_rand(8, 1000000),
                'username' => $request->username,
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
                'user_code' => str_shuffle($pin),
                'age' => $request->age,
                'address' => $request->address,
                'id_class' => $request->id_class,
                'hobby' => $request->hobby,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'role' => $request->role
            ];
            $idNewUser = $newUser['id']; //lấy id new_user
            $this->userRepository->add($newUser);
            return $idNewUser;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function addPoint($id_user, $arrayPoint)
    {
        try {
            $arrPoint = [];
            $arrPoint = array_slice($arrayPoint->toArray(), 11);
            $arrPoints = [];
            $keyPoint = 0;
            foreach ($arrPoint as $key => $point) {
                $arrPoints[$keyPoint]['id']          = mt_rand(8, 1000000);;
                $arrPoints[$keyPoint]['id_user']     = $id_user;
                $arrPoints[$keyPoint]['id_subject']  = $key + 1;
                $arrPoints[$keyPoint]['point']       = $point;
                $keyPoint++;
            }
            $this->pointRepository->addPoint($arrPoints);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function findUser($id)
    {
        return $this->userRepository->find($id);
    }
}