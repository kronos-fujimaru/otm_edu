@extends('participant/layout')

@section('content')
@include('participant/dailyreport/form', ['target' => 'store'])
@endsection
