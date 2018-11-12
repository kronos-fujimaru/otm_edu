@extends('admin/layout')

@section('content')
@include('admin/users/form', ['target' => 'update'])
@endsection
