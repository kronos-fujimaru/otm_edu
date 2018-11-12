@extends('admin/layout')

@section('content')
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h2>理解度テスト</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-12">

    @include('admin/message')

    <h3 class="ops-title">理解度テスト一覧</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <tr>
        <th class="text-center">テスト名</th>
        <th class="text-center">登録日</th>
        <th class="text-center">削除</th>
      </tr>
      @foreach($examinations as $examination)
      <tr>
        <td>
          <a href="/admin/examinations/{{$examination->id}}/edit">{{ $examination->title }}</a>
        </td>
        <td>
            {{$examination->date}}
        </td>
        <td>
          @if($examination->examinationTrainings->count() < 1)
          <form action="/admin/examinations/{{ $examination->id }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
          @else
          研修登録済み
          @endif
        </td>
      </tr>
      @endforeach
    </table>

    <div><a href="/admin/examinations/create" class="btn btn-default">新規作成</a></div>
  </div>
</div>
@endsection
