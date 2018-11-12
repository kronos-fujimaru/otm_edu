@extends('admin/layout')

@section('content')
@include('admin/trainings/form', ['target' => 'store'])
@endsection
