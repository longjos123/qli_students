<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function get_all();
    public function find($id);
    public function editInfo($student,$request);
    public function delete($id);
    public function add($request);
    
}