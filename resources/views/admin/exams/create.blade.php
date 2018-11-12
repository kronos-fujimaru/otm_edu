@extends('admin/layout')

@section('content')
@include('admin/exams/form', ['target' => 'store'])
@endsection
