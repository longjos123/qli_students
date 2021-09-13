@extends('layouts.main');

@section('content')
    <h3>Sửa thông tin</h3>
    <hr>
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="">Tên</label>
            <input type="text" name="fullname" class="form-control" value="{{$student->fullname}}">
        </div>
        <div class="form-group">
            <label for="">Ngày sinh</label>
            <input type="date" name="birth_date" class="form-control" value="{{$student->birth_date}}">
        </div>
        <div class="form-group">
            <label for="">Sở thích</label>
            <input type="text" name="hobby" class="form-control" value="{{$student->hobby}}">
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{$student->address}}">
        </div>
        <div class="form-group">
            <label for="">Giới tính</label>
            <select name="gender" class="form-control" value="{{$student->gender}}">
                <option value="">---Chọn giới tính---</option>
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{route('student.detail',['id' => $student->id])}}" class="btn btn-danger">Hủy</a>
    </form>
@endsection