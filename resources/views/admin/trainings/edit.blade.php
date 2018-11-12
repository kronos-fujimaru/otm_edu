@extends('admin/layout')

@section('content')

@include('admin/trainings/form', ['target' => 'update'])

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">受講者</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>所属企業</th>
                    <th colspan="2">受講期間</th>
                    <th>削除</th>
                </tr>
                @foreach ($training->participants as $participant)
                <tr>
                    <td>{{$participant->id}}</td>
                    <td>
                        <a href="/admin/participants/{{$participant->id}}/edit">
                            {{$participant->user->name}}
                        </a>
                    </td>
                    <td>{{$participant->user->company->name}}</td>
                    <td>{{$participant->date_from}}</td>
                    <td>{{$participant->date_to}}</td>
                    <td>
                        <form action="/admin/participants/{{$participant->id}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <a href="/admin/participants/create?training_id={{$training->id}}" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">人事担当者</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>所属企業</th>
                    <th>削除</th>
                </tr>
                @foreach ($training->managers as $manager)
                <tr>
                    <td>{{$manager->id}}</td>
                    <td>
                        <a href="/admin/managers/{{$manager->id}}/edit">
                        {{$manager->user->name}}
                    </td>
                    <td>{{$manager->user->company->name}}</td>
                    <td>
                        <form action="/admin/managers/{{$manager->id}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <a href="/admin/managers/create?training_id={{$training->id}}" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">理解度テスト</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <span>※受講者がいる理解度テストは修正・削除ができません</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>テスト名</th>
                    <th>実施日</th>
                    <th>ステータス</th>
                    <th>受講者数</th>
                    <th>削除</th>
                </tr>
                @foreach($training->examinationTrainings as $exam)
                <tr>
                    <td>{{$exam->id}}</td>
                    <td>
                        @if( $exam->scores->count() == 0 )
                        <a href="/admin/exams/{{$exam->id}}/edit">
                            {{$exam->examination->title}}
                        </a>
                        @else
                            {{$exam->examination->title}}
                        @endif
                    </td>
                    <td>{{$exam->date}}</td>
                    <td>{!! $exam->statusString() !!}</td>
                    <td>{{$exam->scores->count()}}</td>
                    <td>
                        @if( $exam->scores->count() == 0 )
                            <form action="/admin/exams/{{$exam->id}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <a href="/admin/exams/create?training_id={{$training->id}}" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">アンケート</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>アンケート名</th>
                    <th>URL</th>
                    <th>実施日</th>
                    <th>ステータス</th>
                    <th>削除</th>
                </tr>

                @foreach($training->questions as $question)
                <tr>
                    <td>{{$question->id}}</td>
                    <td>
                        <a href="/admin/questions/{{$question->id}}/edit">
                            {{$question->title}}
                        </a>
                    </td>
                    <td>
                        <a href="{{$question->url}}" target="_blank">
                        <span class="glyphicon glyphicon-globe"></span>
                        </a>
                    </td>
                    <td>{{$question->date}}</td>
                    <td>{!!$question->statusString()!!}</td>
                    <td>
                        <form action="/admin/questions/{{$question->id}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <a href="/admin/questions/create?training_id={{$training->id}}" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">サポート資料</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>アンケート名</th>
                    <th>URL</th>
                    <th>種別</th>
                    <th>ステータス</th>
                    <th>削除</th>
                </tr>
                @foreach ($training->supports as $support)
                <tr>
                    <td>{{$support->id}}</td>
                    <td>
                        <a href="/admin/supports/{{$support->id}}/edit">
                            {{$support->title}}
                        </a>
                    </td>
                    <td>
                        <a href="{{$support->url}}">
                            <span class="glyphicon glyphicon-globe"></span>
                        </a>
                    </td>
                    <td>{{$support->typeString()}}</td>
                    <td>{!!$support->statusString()!!}</td>
                    <td>
                        <form action="/admin/supports/{{$support->id}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <a href="/admin/supports/create?training_id={{$training->id}}" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>
</div>
@endsection
