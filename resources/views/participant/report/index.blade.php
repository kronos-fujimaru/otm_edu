@extends('participant/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
      <div class="col-md-12">
        <h2 class="ops-title">振り返り</h2>
      </div>
    </div>

    @include('admin/message')

    <div class="row">
      <div class="col-md-12">
        <h3 class="ops-title">テーマ一覧</h3>
      </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div style="margin-bottom:10px;"><a href="/participant/report/create" class="btn btn-default">新規作成</a></div>
            <table class="table table-hover">
                <tr>
                    <th>登録日</th>
                    <th>テーマ</th>
                    <th>削除</th>
                </tr>
                @foreach ($participant->reports->sortByDesc('date') as $report)
                <tr>
                    <td>{{ $report->date}}</td>
                    <td>
                        <a href="/participant/report/{{$report->id}}/edit">
                            {{ $report->analysis->theme}}
                        </a>
                    </td>
                    <td>
                        <form action="/participant/report/{{ $report->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
