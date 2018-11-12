@extends('admin/layout')

@section('content')
@include('admin/feedbacks/form', ['target' => 'store'])
@endsection
