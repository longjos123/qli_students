<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ClassRepositoryInterface;
use App\Models\ClassRoom;

class ClassRepository implements ClassRepositoryInterface
{
    public function get_all(){
        return ClassRoom::all();
    }
}