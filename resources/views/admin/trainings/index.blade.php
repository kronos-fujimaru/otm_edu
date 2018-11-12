@extends('admin/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
      <div class="col-md-12">
        <h2 class="ops-title">研修管理</h2>
      </div>
    </div>

    @include('admin/message')

    <div class="row">
      <div class="col-md-12">
        <h3 class="ops-title">研修一覧</h3>
      </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>研修タイトル</th>
                    <th>ステータス</th>
                    <th>開催地</th>
                    <th colspan="2">開催期間</th>
                    <th>講師</th>
                    <th>動画配信ユーザID</th>
                    <th>削除</th>
                </tr>
                @foreach($trainings as $training)
                <tr>
                    <td>{{$training->id}}</td>
                    <td><a href="/admin/trainings/{{$training->id}}/edit">{{$training->title}}</a></td>
                    <td>{!!$training->statusString()!!}</td>
                    <td>{{$training->place}}</td>
                    <td>{{$training->date_from}}</td>
                    <td>{{$training->date_to}}</td>
                    <td>{{$training->instructor()->withTrashed()->first()->name}}</td>
                    <td>@if($training->videourl != null)
                        {{$training->videourl->url_user_id}}
                        @endif
                    </td>
                    <td>
                        <form action="/admin/trainings/{{ $training->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        <div><a href="/admin/trainings/create" class="btn btn-default">新規作成</a></div>
      </div>
  </div>
</div>
@endsection
