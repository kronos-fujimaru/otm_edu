@extends('admin/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>問い合わせ</h2>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-12">
            <h3>運営からのお知らせ</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        @if ($kronos->fromTopics->count() == 0)
        <div class="alert alert-info" role="alert">
            運営からのお知らせは未登録です。
        </div>
        @else
        <table class="table">
            <tr>
                <th>ID</th>
                <th>件名</th>
                <th>お知らせ先</th>
                <th>最終更新者</th>
                <th>最終更新日時</th>
                <th>コメント数</th>
                <th>削除</th>
            </tr>
            @foreach ($kronos->fromTopics as $topic)
            <tr>
                <td>{{$topic->id}}</td>
                <td><a href="/admin/topics/{{$topic->id}}">{{$topic->title}}</a></td>
                <td>{{$topic->toCompany->name}}</td>
                <td>{{$topic->lastMessageUpdatedUserName()}}</td>
                <td>{{$topic->lastMessageUpdatedAt()}}</td>
                <td>{{$topic->messages->count() + 1}} 件</td>
                <td>
                    <form action="/admin/topics/{{ $topic->id }}" method="post">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @endif
        <div><a href="/admin/topics/create" class="btn btn-default">新規作成</a></div>
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
        @if ($kronos->toTopics->count() == 0)
        <div class="alert alert-info" role="alert">
            オープン研修に関する問い合わせはありません。
        </div>
        @else
        <table class="table">
            <tr>
                <th>ID</th>
                <th>件名</th>
                <th>問い合わせ元</th>
                <th>最終更新者</th>
                <th>最終更新日時</th>
                <th>コメント数</th>
            </tr>
            @foreach ($kronos->toTopics as $topic)
            <tr>
                <td>{{$topic->id}}</td>
                <td><a href="/admin/topics/{{$topic->id}}">{{$topic->title}}</a></td>
                <td>{{$topic->fromCompany->name}}</td>
                <td>{{$topic->lastMessageUpdatedUserName()}}</td>
                <td>{{$topic->lastMessageUpdatedAt()}}</td>
                <td>{{$topic->messages->count() + 1}} 件</td>
            </tr>
            @endforeach
        </table>
        @endif
        </div>
    </div>
</div>
@endsection
