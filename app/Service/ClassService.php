<?php

namespace App\Service;

use App\Repositories\Eloquents\ClassRepository;

class ClassService
{
    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function all()
    {
        return $this->classRepository->getAll();
    }
}