<?php
namespace App\Repositories\Contracts;

interface PointRepositoryInterface
{
    public function getAll();
    public function addPoint($request, $id_user);
    public function findPointUser($id);
    public function addPointEdit($id, $request);
    // public function find($id);
    // public function add();
    
}