@extends('index')

@section('content')

    <item-component :full="true" :item="{{$item->toJson()}}"></item-component>

@endsection