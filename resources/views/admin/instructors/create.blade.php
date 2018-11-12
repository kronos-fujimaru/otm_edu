@extends('admin/layout')

@section('content')
@include('admin/instructors/form', ['target' => 'store'])
@endsection
