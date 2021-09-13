@extends('layouts.main')
@section('content')

    <form action="" method="post">
        @csrf
        @foreach ($student_point as $item)
                @foreach ($subjects as $subject)
                    @if ($item->id_subject === $subject->id)
                        <div class="col-2">
                            <div class="form-group">
                                <label for="">{{$item->name}}</label>
                                <input type="text" name="{{$item->id}}" class="form-control" value="{{$item->point}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
            <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection