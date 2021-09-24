@extends('layouts.main');

@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        {{-- <th>Lớp</th> --}}
        @foreach ($subject as $item)
            <th scope="col" id="{{$item->name}}">{{$item->name}}</th>
        @endforeach
        <th scope="col">
            <a href="{{route('student.view_add')}}" class="btn btn-primary" style="width: 110px;">Thêm</a>
            <a href="{{route('student.logout')}}" class="btn btn-danger">Đăng xuất</a>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
        <tr>
            <th scope="row">{{$student->id}}</th>
            <td>{{$student->fullname}}</td>
            {{-- <td>{{$student->classroom->name}}</td> --}}
              @foreach($student->point as $item)
                  @foreach ($subject as $sub)
                      @if ($item->id_subject === $sub->id)
                          <td>{{$item->point}}</td>
                      @endif
                  @endforeach
              @endforeach
              
            <td>
                <a href="{{route('student.detail', ['id' => $student->id])}}" class="btn btn-success">Xem thông tin</a>
                <a href="{{route('student.editPoint', ['id' => $student->id])}}" class="btn btn-primary">Sửa điểm</a>
                <a href="{{route('student.delete', ['id' => $student->id])}}" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
      @endforeach
      
    </tbody>
  </table>
@endsection



