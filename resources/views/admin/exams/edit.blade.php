@extends('admin/layout')

@section('content')
@include('admin/exams/form', ['target' => 'update'])
@endsection
