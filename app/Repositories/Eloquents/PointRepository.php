<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\PointRepositoryInterface;
use App\Models\Point;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\DB;

class PointRepository implements PointRepositoryInterface
{
    public function getAll()
    {
        return Point::all();
    }
    public function addPoint($request, $id_user)
    {
       try{
        $arrPoint = [];
        $arrPoint = array_slice($request->toArray(), 11);
        $saveArrPoint = [];
        $keyPoint = 0;
        foreach ($arrPoint as $key => $point) {
            $saveArrPoint[$keyPoint]['id'] = mt_rand(8, 1000000);;
            $saveArrPoint[$keyPoint]['id_user'] = $id_user;
            $saveArrPoint[$keyPoint]['id_subject'] = $key + 1;
            $saveArrPoint[$keyPoint]['point'] = $point;
            $keyPoint++;
        }
        Point::insert($saveArrPoint);
       }catch(Exception $e){
        throw new Exception($e->getMessage());
       }
    }
    public function findPointUser($id)
    {
        return Point::where('id_user', '=', $id)
                    ->join('users', 'point.id_user', '=', 'users.id')
                    ->join('subjects', 'point.id_subject', '=', 'subjects.id')
                    ->get();
    }
    public function addPointEdit($id, $request)
    {
        try{
            DB::beginTransaction();
            Point::where('id_user', '=', $id)->delete();
            
            $arrPoint = [];
            $arrPoint = array_slice($request->toArray(), 1);
            $saveArrPoint = [];
            $keyPoint = 0;
            foreach ($arrPoint as $key => $point) {
                $saveArrPoint[$keyPoint]['id'] = mt_rand(8, 1000000);;
                $saveArrPoint[$keyPoint]['id_user'] = $id;
                $saveArrPoint[$keyPoint]['id_subject'] = $key + 1;
                $saveArrPoint[$keyPoint]['point'] = $point;
                $keyPoint++;
            }
            Point::insert($saveArrPoint);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }
}