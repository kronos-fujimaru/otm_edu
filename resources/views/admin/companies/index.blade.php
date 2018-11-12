@extends('admin/layout')

@section('content')
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2 class="ops-title">受講企業管理</h2>
    </div>
  </div>

  @include('admin/message')

  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">受講企業一覧</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-11 col-md-offset-1">
      <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>企業名</th>
            <th>人事担当者数</th>
            <th>受講者数</th>
            <th>削除</th>
        </tr>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td><a href="/admin/companies/{{$company->id}}/edit">{{ $company->name }}</a></td>
            <td>{{ $company->managers()->count() }}</td>
            <td>{{ $company->participants()->count() }}</td>
            <td>
                <form action="/admin/companies/{{ $company->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
      </table>
      <div><a href="/admin/companies/create" class="btn btn-default">新規作成</a></div>
    </div>
  </div>
@endsection
