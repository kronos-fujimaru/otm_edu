@extends('admin/layout')

@section('content')
@include('admin/companies/form', ['target' => 'store'])
@endsection
