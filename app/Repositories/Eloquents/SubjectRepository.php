<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Models\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function get_all(){
        return Subject::all();
    }
}