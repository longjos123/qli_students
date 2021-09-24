<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use App\Models\Point;
use App\Constants\Constant;


class UserRepository implements UserRepositoryInterface
{
    protected $user, $point;

    public function __construct(User $user, Point $point)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->where('role', '=', Constant::CLIENT)->get();
    }
    public function find($id)
    {
        return $this->user->findOrFail($id);
    }
    public function editInfo($request)
    {
        $this->user->fill($request->all());
        $this->user->save();
        // $student->fill($request->all());
        // $student->save();   
    }
    public function delete($id)
    {
        $this->point->findOrFail($id)->delete();   //Xóa điểm trong bảng point
        $this->user->findOrFail($id)->delete();    //Xóa user trong bảng users
    }
    public function add($request)
    {
        $this->user->create($request); 
    }
}