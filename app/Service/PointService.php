<?php

namespace App\Service;

use App\Repositories\Eloquents\PointRepository;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\DB;
use Exception;

class PointService
{
    public function __construct(PointRepository $pointRepository)
    {
        $this->pointRepository = $pointRepository;
    }

    public function findPointStudent($id){
        $this->pointRepository->findPoint($id);
    }

    public function editPoint($id_user, $point){
        try {
            DB::beginTransaction();
            $this->pointRepository->deletePoint($id_user);
            $arrPoint = [];
            $arrPoint = array_slice($point->toArray(), 1);
            $arrPoints = [];
            $keyPoint = 0;
            foreach ($arrPoint as $key => $point) {
                $arrPoints[$keyPoint]['id']         = mt_rand(8, 1000000);;
                $arrPoints[$keyPoint]['id_user']    = $id_user;
                $arrPoints[$keyPoint]['id_subject'] = $key + 1;
                $arrPoints[$keyPoint]['point']      = $point;
                $keyPoint++;
            }
            $this->pointRepository->addPointEdit($arrPoints);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}