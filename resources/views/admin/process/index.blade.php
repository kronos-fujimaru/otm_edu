@extends('admin/layout')

@section('content')

<div class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h2>研修管理システム</h2>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-12">
            <h3>研修一覧</h3>
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
                </tr>
                @foreach ($trainings as $training)
                <tr>
                    <td>{{$training->id}}</td>
                    <td>
                        <a href="/admin/process/trainings/{{$training->id}}">
                            {{$training->title}}
                        </a>
                    </td>
                    <td>{!!$training->statusString()!!}</td>
                    <td>{{$training->place}}</td>
                    <td>{{$training->date_from}}</td>
                    <td>{{$training->to}}</td>
                    <td>{{$training->instructor()->withTrashed()->first()->name}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>補足資料</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
          <ul>
            <li><a href="https://docs.google.com/spreadsheets/d/1AW7LHzkhb4qpNo1T_vERptnfvtWxUkywk7vrBdJlNj0/edit#gid=494100799" target="_blank">自習申請フォーム</a></li>
          </ul>
        </div>
    </div>
</div>
@endsection
