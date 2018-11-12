@extends('admin/layout')

@section('content')
@include('admin/communications/form', ['target' => 'store'])
@endsection
