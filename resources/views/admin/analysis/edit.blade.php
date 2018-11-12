@extends('admin/layout')

@section('content')
@include('admin/analysis/form', ['target' => 'update'])
@endsection
