<?php
namespace App\Repositories\Contracts;

interface PointRepositoryInterface
{
    public function get_all();
    public function add_point($request, $id_user);
    public function find_point_user($id);
    public function delete_point_user($id);
    public function add_point_edit($id, $request);
    // public function find($id);
    // public function add();
    
}