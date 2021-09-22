<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddRequestForm;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Repositories\Contracts\PointRepositoryInterface;
use App\Repositories\Contracts\ClassRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Constants\Constant;

// use App\Constant\Const;

class UserController extends Controller
{
    protected $userRepository;
    protected $subjectRepository;
    protected $pointRepository;
    protected $classRepository;
    public function __construct(
        UserRepositoryInterface $userRepository,
        SubjectRepositoryInterface $subjectRepository,
        PointRepositoryInterface $pointRepository,
        ClassRepositoryInterface $classRepository
    ) {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->pointRepository = $pointRepository;
        $this->classRepository = $classRepository;
    }
    public function show()
    {

        $students = $this->userRepository->getAll();
        //lấy dữ liệu các môn học
        $subject = $this->subjectRepository->getAll();
        $students->load('point', 'subject', 'classroom'); //load ra những cột của user trong bảng point và subject và clas

        return view('admin.show', compact('students', 'subject'));
    }

    /**
     * Hiển thị chi tiết học sinh
     * @param int $id
     */
    public function detail(int $id)
    {
        $_ADMIN_ROLE = Constant::_ADMIN_ROLE;
        $_GENDER_MALE = Constant::_ADMIN_ROLE;
        $student = $this->userRepository->find($id);

        return view('admin.detail', compact('student', '_ADMIN_ROLE', '_GENDER_MALE'));
    }

    /**
     * Sửa chi tiết học sinh
     * @param int $id
     */
    public function editInfo(int $id)
    {
        $student = $this->userRepository->find($id);

        return view('admin.editInfo', compact('student'));
    }

    /**
     * Lưu chi tiết học sinh
     * @param int $id
     * @param array $request
     */
    public function postEditinfo(int $id, Request $request)
    {
        $student = $this->userRepository->find($id);
        $this->userRepository->editInfo($student, $request);

        return redirect(route('student.detail', ['id' => $student->id]));;
    }

    /**
     * Xóa học sinh và điểm
     * @param int $id
     */
    public function delete($id)
    {
        $this->userRepository->delete($id);

        return redirect()->back();
    }
    /**
     * Thêm học sinh
     */
    public function add()
    {
        $classroom = $this->classRepository->getAll();
        $subject = $this->subjectRepository->getAll();

        return view('admin.add', compact('classroom', 'subject'));
    }
    /**
     * Lưu học sinh
     * @param array $request
     */
    public function postAdd(AddRequestForm $request)
    {
        // $subject = $this->subjectRepository->getAll();
        try {
            DB::beginTransaction();
            //thêm mới user
            $idNewUser = $this->userRepository->add($request);
            //thêm điểm vào bảng point cho new_user
            $this->pointRepository->addPoint($request, $idNewUser);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        return redirect(route('student.show'));
    }
    public function editPoint($id)
    {
        $studentPoint = $this->pointRepository->findPointUser($id);
        $subjects = $this->subjectRepository->getAll();

        return view('admin.edit_point', compact('studentPoint', 'subjects'));
    }
    public function postEditPoint($id, Request $request)
    {
        //tạo 1 dữ liệu điểm mới cho user
        try {
            $this->pointRepository->addPointEdit($id, $request);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

        return redirect(route('student.show'));
    }
}