@extends('manager/layout')

@section('content')
@include('manager/communications/form', ['target' => 'store'])
@endsection
