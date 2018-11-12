@extends('participant/layout')

@section('content')
@include('participant/report/form', ['target' => 'store'])
@endsection
