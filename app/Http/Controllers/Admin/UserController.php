<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddRequestForm;
use Illuminate\Support\Facades\DB;
use App\Service\UserService;
use App\Service\SubjectService;
use App\Service\ClassService;
use App\Service\PointService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Constants\Constant;


class UserController extends Controller
{
    protected $userService;
    protected $subjectService;
    protected $classService;

    public function __construct(
        UserService $userService,
        SubjectService $subjectService,
        ClassService $classService,
        PointService $pointService
    ){
        $this->userService = $userService;
        $this->subjectService = $subjectService;
        $this->classService = $classService;
        $this->pointService = $pointService;
    }
    public function show()
    {

        $students = $this->userService->all();
        //lấy dữ liệu các môn học
        $subject = $this->subjectService->all();
        $students->load('point', 'subject', 'classroom'); //load ra những cột của user trong bảng point và subject và clas

        return view('admin.show', compact('students', 'subject'));
    }

    /**
     * Thêm học sinh
     * lấy thông tin lớp và môn để đưa ra view
     */
    public function view_add()
    {
        $classroom = $this->classService->all();
        $subject = $this->subjectService->all();

        return view('admin.add', compact('classroom', 'subject'));
    }
    /**
     * Lưu học sinh
     * @param array $request
     */
    public function postAdd(AddRequestForm $request)
    {
        DB::beginTransaction();
        //thêm mới user
        $idNewUser = $this->userService->addUser($request);
        //thêm điểm vào bảng point cho new_user
        $this->userService->addPoint($idNewUser, $request);
        DB::commit();

        DB::rollBack();

        return redirect(route('student.show'));
    }

    /**
     * Hiển thị chi tiết học sinh
     * @param int $id
     */
    public function detail(int $id)
    {
        $student = $this->userService->findUser($id);

        return view('admin.detail', ['student' => $student, 'ADMIN_ROLE' => Constant::ADMIN_ROLE, 'GENDER_MALE' => Constant::GENDER_MALE]);
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
        try {
            // DB::beginTransaction();
            $this->userService->findUser($id)->delete();
            // $this->PointService->findPointStudent($id)->delete();
            // DB::commit();
        } catch (Exception $e) {
            // DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Sửa điểm
     * @param int $id
     */
    public function editPoint(int $id)
    {
        $studentPoint = $this->pointService->findPointStudent($id);
        $subjects = $this->subjectService->all();

        return view('admin.edit_point', compact('studentPoint', 'subjects'));
    }
    public function postEditPoint($id, Request $request)
    {
        //tạo 1 dữ liệu điểm mới cho user
        try {
            $this->pointService->addPointEdit($id, $request);
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

        return redirect(route('student.show'));
    }
}