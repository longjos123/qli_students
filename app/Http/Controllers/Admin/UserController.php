<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddRequestForm;
use App\Models\User;
use App\Models\Subject;
use App\Models\Point;
use App\Models\ClassRoom;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Repositories\Contracts\PointRepositoryInterface;
use App\Repositories\Contracts\ClassRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;
    protected $subjectRepository;
    protected $pointRepository;
    protected $classRepository;
    public function __construct(UserRepositoryInterface $userRepository, 
                                SubjectRepositoryInterface $subjectRepository,
                                PointRepositoryInterface $pointRepository,
                                ClassRepositoryInterface $classRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->pointRepository = $pointRepository;
        $this->classRepository = $classRepository;
    }
    public function show(){
        $students = $this->userRepository->get_all();
        //lấy dữ liệu các môn học
        $subject = $this->subjectRepository->get_all();
        $students -> load('point', 'subject','classroom'); //load ra những cột của user trong bảng point và subject và clas
        return view('admin.show', compact('students','subject'));
        
    }
    public function detail($id){
        $student = $this->userRepository->find($id);
        return view('admin.detail', compact('student'));
    }
    public function editInfo($id){
        $student = $this->userRepository->find($id);
        return view('admin.editInfo', compact('student'));
    }
    public function postEditinfo($id, Request $request){
        $student = $this->userRepository->find($id);
        $this->userRepository->editInfo($student,$request);
        return redirect(route('student.detail', ['id' => $student->id]));;
    }
    public function delete($id){
        $this->userRepository->delete($id);
        return redirect()->back();
    }  
    public function add(){
        $classroom = $this->classRepository->get_all();
        $subject = $this->subjectRepository->get_all();
        return view('admin.add', compact('classroom', 'subject'));   
    }
    public function postAdd(AddRequestForm $request){
        $subject = $this->subjectRepository->get_all();
        //thêm mới user
        $id_new_user = $this->userRepository->add($request);
        //thêm điểm vào bảng point cho new_user
        $this->pointRepository->add_point($request, $id_new_user);
        return redirect(route('student.show'));
    }
    public function editPoint($id){
         $student_point = $this->pointRepository->find_point_user($id);
        $subjects = $this->subjectRepository->get_all();
         
         return view('admin.edit_point', compact('student_point','subjects'));
    }
    public function postEditPoint($id, Request $request){
        //Xóa dữ liệu điểm cũ
        $student_point_edit = $this->pointRepository->delete_point_user($id);
        //tạo 1 dữ liệu điểm mới cho user
        $this->pointRepository->add_point_edit($id, $request);
        return redirect(route('student.show'));
    }
}