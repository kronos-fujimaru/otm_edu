@extends('admin/layout')

@section('content')
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2 class="ops-title">講師管理</h2>
    </div>
  </div>

  @include('admin/message')

  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">講師一覧</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-11 col-md-offset-1">

      <table class="table table-hover">
        <tr>
          <th>名前</th>
          <th>画像</th>
          <th>削除</th>
        </tr>
        @foreach($instructors as $instructor)
        <tr>
          <td><a href="/admin/instructors/{{ $instructor->id }}/edit">{{ $instructor->name }}</a></td>
          <td><img src="{{ $instructor->icon_url }}"></td>
          <td>
            <form action="/admin/instructors/{{ $instructor->id }}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
      <div><a href="/admin/instructors/create" class="btn btn-default">新規作成</a></div>
    </div>
  </div>
</div>


@endsection
