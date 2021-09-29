<?php

namespace App\Service;

use App\Repositories\Eloquents\SubjectRepository;

class SubjectService
{
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function all(){
        return $this->subjectRepository->getAll();
    }
}