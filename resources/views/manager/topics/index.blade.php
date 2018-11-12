@extends('manager/layout')

@section('content')
@if ($manager == null)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>問い合わせ一覧</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => '問い合わせ一覧'])
      </div>
    </div>
  </div>
</div>
@else
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>問い合わせ</h2>
        </div>
    </div>

    @include('manager/message')

    <div class="row">
        <div class="col-md-12">
            <h3>運営からのお知らせ</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        @if ($manager->user->company->toTopics->count() == 0)
        <div class="alert alert-info" role="alert">
            運営（クロノス）からのお知らせを表示します。現在、運営からのお知らせはありません。
        </div>
        @else
        <table class="table">
            <tr>
                <th>ID</th>
                <th>件名</th>
                <th>最終更新日時</th>
                <th>最終更新者</th>
                <th>コメント数</th>
            </tr>
            @foreach ($manager->user->company->toTopics as $topic)
            <tr>
                <td>{{$topic->id}}</td>
                <td><a href="/manager/topics/{{$topic->id}}">{{$topic->title}}</a></td>
                <td>{{$topic->lastMessageUpdatedAt()}}</td>
                <td>{{$topic->lastMessageUpdatedUserName()}}</td>
                <td>{{$topic->messages->count() + 1}} 件</td>
            </tr>
            @endforeach
        </table>
        @endif
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>問い合わせ一覧</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        @if ($manager->user->company->fromTopics->count() == 0)
        <div class="alert alert-info" role="alert">
            オープン研修に関するお問い合わせはこちらです。お問い合わせ頂いた内容は運営スタッフが確認し回答いたします。お気軽にご利用ください。
        </div>
        <div><a href="/manager/topics/create" class="btn btn-default">新規作成</a></div>
        @else
        <table class="table">
            <tr>
                <th>ID</th>
                <th>件名</th>
                <th>最終更新日時</th>
                <th>最終更新者</th>
                <th>コメント数</th>
                <th>削除</th>
            </tr>
            @foreach ($manager->user->company->fromTopics as $topic)
            <tr>
                <td>{{$topic->id}}</td>
                <td><a href="/manager/topics/{{$topic->id}}">{{$topic->title}}</a></td>
                <td>{{$topic->lastMessageUpdatedAt()}}</td>
                <td>{{$topic->lastMessageUpdatedUserName()}}</td>
                <td>{{$topic->messages->count() + 1}} 件</td>
                <td>
                    <form action="/manager/topics/{{ $topic->id }}" method="post">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div><a href="/manager/topics/create" class="btn btn-default">新規作成</a></div>
        @endif
        </div>
    </div>
</div>
@endif
@endsection
