@extends('admin/layout')

@section('content')
@include('admin/managers/form', ['target' => 'update'])
@endsection
