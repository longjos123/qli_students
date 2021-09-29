@extends('layouts.main');

@section('content')
<h3>Thêm</h3>
<hr>
<form action="{{route('student.postadd')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-6">
            <h4>Thông tin</h4>
            <div class="form-group">
                <label for="">Username</label>
                @error('username')
                    <span class="text-danger">{{$message}}</span>
                 @enderror
                <input type="text" name="username" class="form-control" value="{{old('username')}}">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="password" name="password" class="form-control"value="{{old('password')}}">
            </div>
            <div class="form-group">
                <label for="">Fullname</label>
                @error('fullname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="fullname" class="form-control" value="{{old('fullname')}}">
            </div>
            <div class="form-group">
                <label for="">Vai trò</label>
                @error('role')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <select name="role" class="form-control" value="{{old('role')}}">
                    <option value="">---Chọn vai trò---</option>
                    <option value="1">Admin</option>
                    <option value="0">Student</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Giới tính</label>
                @error('gender')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <select name="gender" class="form-control" value="{{old('gender')}}">
                    <option value="">---Chọn giới tính---</option>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Ngày sinh</label>
                @error('birth_date')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="date" name="birth_date" class="form-control" value="{{old('birth_date')}}"> 
            </div>
            <div class="form-group">
                <label for="">Tuổi</label>
                @error('age')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="age" class="form-control" value="{{old('age')}}">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                @error('address')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="address" class="form-control" value="{{old('address')}}">
            </div>
            <div class="form-group">
                <label for="">Sở thích</label>
                @error('hobby')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <input type="text" name="hobby" class="form-control" value="{{old('hobby')}}">
            </div>
        </div>
        <div class="col-6">
            <h4>Điểm</h4>
            <div class="row">
                <div class="col-12">
                    <label for="">Lớp</label>
                    @error('id_class')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <select name="id_class" class="form-control" value="{{old('id_class')}}">
                        <option value="">---Chọn lớp---</option>
                        @foreach ($classroom as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                @foreach ($subject as $item)
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">{{$item->name}}</label>
                                <input type="text" name="{{$item->id}}" class="form-control">
                                @error('{{$item->id}}')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                @endforeach
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('student.show')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    <br>
    
   
</form>
@endsection