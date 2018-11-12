@extends('admin/layout')

@section('content')
@include('admin/participants/form', ['target' => 'update'])
@endsection
