@extends('admin/layout')

@section('content')
@include('admin/absences/form', ['target' => 'store'])
@endsection
