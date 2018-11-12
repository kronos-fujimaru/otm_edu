@extends('manager/layout')

@section('content')
@include('manager/dailyreport/form', ['target' => 'update'])
@endsection
