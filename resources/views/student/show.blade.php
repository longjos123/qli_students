@extends('layouts.main');

@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        <th scope="col">Lớp</th>
        @foreach ($subject as $item)
            <th scope="col">{{$item->name}}</th>
        @endforeach
        <th scope="col"> 
            <a href="{{route('student.logout')}}" class="btn btn-danger">Đăng xuất</a>
        </th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach (Auth::user() as $student) --}}
        <tr>
            <th scope="row">{{Auth::id()}}</th>
            <td>{{Auth::user()->fullname}}</td>
            <td>{{Auth::user()->id_class}}</td>
              @foreach (Auth::user()->point as $item)                
                    <td>{{$item->point}}</td>
              @endforeach
            <td>
                <a href="{{route('student.detail', ['id' => Auth::id()])}}" class="btn btn-success">Xem thông tin</a>
            </td>
        </tr>
      {{-- @endforeach --}}
      
    </tbody>
  </table>
@endsection


