@extends('index')

@section('content')

    @if($exist)
        <div class="alert alert-danger" role="alert">
            Задание <strong>УЖЕ</strong> выполняется!
            <hr />
            <a href="{{ route('main') }}">На главную</a>
        </div>
    @else
        <div class="alert alert-success" role="alert">
            Задание добавлено в очередь!
            <hr />
            <a href="{{ route('main') }}">На главную</a>
        </div>
    @endif

@endsection