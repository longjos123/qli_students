<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ClassRepositoryInterface;
use App\Models\ClassRoom;

class ClassRepository implements ClassRepositoryInterface
{
    protected $classroom;
    
    public function __construct(ClassRoom $classroom)
    {
        $this->classroom = $classroom;
    }
    public function getAll(){
        return $this->classroom->all();
    }
}