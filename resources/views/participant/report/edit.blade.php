@extends('participant/layout')

@section('content')
@include('participant/report/form', ['target' => 'update'])
@endsection
