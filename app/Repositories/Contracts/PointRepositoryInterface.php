<?php
namespace App\Repositories\Contracts;

interface PointRepositoryInterface
{
    public function getAll();
    public function addPoint($request);
    public function findPoint($id);
    public function addPointEdit($request);
    public function deletePoint($id);
    // public function find($id);
    // public function add();
    
}