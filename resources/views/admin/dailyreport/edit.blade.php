@extends('admin/layout')

@section('content')
@include('admin/dailyreport/form', ['target' => 'update'])
@endsection
