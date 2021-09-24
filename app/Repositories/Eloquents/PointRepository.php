<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\PointRepositoryInterface;
use App\Models\Point;


class PointRepository implements PointRepositoryInterface
{
    protected $point;

    public function __construct(Point $point)
    {
        $this->point = $point;
    }

    public function getAll()
    {
        return $this->point->all();
    }
    public function addPoint($request)
    {
        return $this->point->insert($request);
    }

    public function findPoint($id)
    {
        return $this->point->find('id_user', '=', $id)
            ->join('users', 'point.id_user', '=', 'users.id')
            ->join('subjects', 'point.id_subject', '=', 'subjects.id')
            ->get();
    }

    public function deletePoint($id)
    {
        $this->point->where('id', '=', $id)->delete();
    }
    public function addPointEdit($request)
    {
        return $this->point->insert($request);
    }
}