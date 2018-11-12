@extends('admin/layout')

@section('content')
@include('admin/notes/form', ['target' => 'store'])
@endsection
