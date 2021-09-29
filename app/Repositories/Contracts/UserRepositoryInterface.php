<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function editInfo($request);
    public function delete($id);
    public function add($request);
    
}