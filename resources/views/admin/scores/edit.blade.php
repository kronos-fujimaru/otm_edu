@extends('admin/layout')

@section('content')
@include('admin/scores/form', ['target' => 'update'])
@endsection
