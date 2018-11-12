@extends('admin/layout')

@section('content')
@include('admin/examinations/form', ['target' => 'store'])
@endsection
