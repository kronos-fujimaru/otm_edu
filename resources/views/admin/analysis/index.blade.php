@extends('admin/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
      <div class="col-md-12">
        <h2 class="ops-title">適正分析レポート</h2>
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
            <div style="margin-bottom:10px;"><a href="/admin/analysis/create" class="btn btn-default">新規作成</a></div>
            <table class="table table-hover">
                <tr>
                    <th>実施日</th>
                    <th>テーマ</th>
                    <th>ステータス</th>
                    <th>回答数</th>
                    <th>削除</th>
                </tr>
                @foreach ($analyses as $analysis)
                <tr>
                    <td>{{$analysis->date}}</td>
                    <td>
                        <a href="/admin/analysis/{{$analysis->id}}/edit">
                            {{$analysis->theme}}
                        </a>
                    </td>
                    <td>{!!$analysis->statusString()!!}</td>
                    <td>{{$analysis->reports->count()}}</td>
                    @if ($analysis->reports->count() == 0)
                        <td>
                            <form action="/admin/analysis/{{ $analysis->id }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
