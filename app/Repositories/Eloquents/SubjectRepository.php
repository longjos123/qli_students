<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Models\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{
    protected $subject;
    
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }
    public function getAll(){
        return $this->subject->all();
    }
}