@extends('layouts.main');

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" width="250px">
        </div>
        <div class="col-8">
            <h4>Họ và tên: {{$student->fullname}}</h4>
            <p>Mã học sinh: {{$student->user_code}}</p>
            <p>Ngày sinh: {{$student->birth_date}}</p>
            <p>Sở thích: {{$student->hobby}}</p>
            <p>Địa chỉ: {{$student->address}}</p>
            <p>Giới tính: 
                <?php
                $gender = $student->gender === $GENDER_MALE ? 'Nam' :'Nữ';?>  
                {{$gender}}
            </p>
            @if(Auth::user()->role == $ADMIN_ROLE)
                <a href="{{route('editInfo',['id' => $student->id])}}" class="btn btn-primary">Sửa thông tin</a>
                <a href="{{route('student.show')}}" class="btn btn-secondary">Bảng điểm</a>   
            @else
                <a href="{{route('show-point-client')}}" class="btn btn-secondary">Bảng điểm</a>  
            @endif
            
        </div>
    </div>
    <hr>
@endsection