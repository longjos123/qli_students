<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ClassRepositoryInterface;
use App\Models\ClassRoom;

class ClassRepository implements ClassRepositoryInterface
{
    public function getAll(){
        return ClassRoom::all();
    }
}