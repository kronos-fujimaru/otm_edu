@extends('admin/layout')

@section('content')
@include('admin/questions/form', ['target' => 'store'])
@endsection
