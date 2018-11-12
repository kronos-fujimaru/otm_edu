@extends('participant/layout')

@section('content')
@if ($participant == null)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>日報</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => '日報'])
      </div>
    </div>
  </div>
</div>
@else
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h2>日報</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-12">

    @include('participant/message')

    <h3 class="ops-title">日報一覧</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <tr>
        <th class="text-center">登録日</th>
        <th class="text-center">成果物</th>
        <th class="text-center">講師確認</th>
        <th class="text-center">担当者確認</th>
        <th class="text-center">講師コメント</th>
        <th class="text-center">担当者コメント</th>
        <th class="text-center">削除</th>
      </tr>
      {{-- */ $dailyReportPages = $participant->dailyReports()->orderBy('date', 'desc')->paginate(5, ["*"], "dailyreport") /* --}}
      @foreach($dailyReportPages as $dailyReport)
      <tr>
        <td>
          <a href="/participant/dailyreport/{{$dailyReport->id}}/edit">{{ $dailyReport->date }}</a>
        </td>
        <td>
          @if($dailyReport->dailyWork == null)
            <div class="col-md=12">
              -
            </div>
          @else
            <a href="/participant/dailywork/file/{{$dailyReport->dailyWork->id}}">{{$dailyReport->dailyWork->file_name}}</a>
          @endif
        </td>
        <td>{!!$dailyReport->adminStatusString()!!}</td>
        <td>{!!$dailyReport->managerStatusString()!!}</td>
        <td>{!!$dailyReport->adminCommentStatusString()!!}</td>
        <td>{!!$dailyReport->managerCommentStatusString()!!}</td>
        <td>
          @if($dailyReport->isManagerYet())
          <form action="/participant/dailyreport/{{ $dailyReport->id }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
          @else
          削除不可
          @endif
        </td>
      </tr>
      @endforeach
    </table>
    {!! $dailyReportPages !!}

    <div><a href="/participant/dailyreport/create" class="btn btn-default">新規作成</a></div>
  </div>
</div>
@endif
@endsection
