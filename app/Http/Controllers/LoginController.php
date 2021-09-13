<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class LoginController extends Controller
{
    protected $subjectRepository;
    public function __construct( SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }
    public function login(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
        $subject = $this->subjectRepository->get_all();
        // dd($request);
        if(Auth::attempt(['username' => $request-> username, 'password' => $request -> password, 'role' => 1])){
            return redirect(route('student.show'));
        }
        if(Auth::attempt(['username' => $request-> username, 'password' => $request -> password, 'role' => 0])){
            return view('student.show', compact('subject'));
        }
        return redirect()->back()->with('msg', 'Sai thong tin dang nhap');
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
   
}