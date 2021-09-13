<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\PointRepositoryInterface;
use App\Models\Point;
use Illuminate\Support\Facades\DB;

class PointRepository implements PointRepositoryInterface
{
    public function get_all(){
        return Point::all();
    }
    public function add_point($request, $id_user){
        $arr_point = [];
        $arr_point = array_slice($request->toArray(), 11);
        $save_arr_point = [];
        $key_point = 0;
        foreach($arr_point as $key => $point){
            $save_arr_point[$key_point]['id'] = mt_rand(8, 1000000);;
            $save_arr_point[$key_point]['id_user'] = $id_user;
            $save_arr_point[$key_point]['id_subject'] = $key + 1;
            $save_arr_point[$key_point]['point'] = $point;
            $key_point++;
        }
        Point::insert($save_arr_point);
    }
    public function find_point_user($id){
        return DB::table('point')->where('id_user', '=', $id)
                                ->join('users','point.id_user','=','users.id')
                                ->join('subjects','point.id_subject','=','subjects.id')
                                ->get();
    }
    public function delete_point_user($id){
        return DB::table('point')->where('id_user','=',$id)->delete();
    }
    public function add_point_edit($id, $request){
        $arr_point = [];
        $arr_point = array_slice($request->toArray(), 1);
        $save_arr_point = [];
        $key_point = 0;
        foreach($arr_point as $key => $point){
            $save_arr_point[$key_point]['id'] = mt_rand(8, 1000000);;
            $save_arr_point[$key_point]['id_user'] = $id;
            $save_arr_point[$key_point]['id_subject'] = $key + 1;
            $save_arr_point[$key_point]['point'] = $point;
            $key_point++;
        }
        Point::insert($save_arr_point);
    }
}