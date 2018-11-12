@extends('manager/layout')

@section('content')
@if ($user->currentManagers() == null || $user->currentManagers()->count() == 0)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>受講状況</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => '受講状況'])
      </div>
    </div>
  </div>
</div>
@else
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>受講状況</h2>
        </div>
    </div>

  @foreach ($user->currentManagers() as $currentManager)
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h3>{{$currentManager->training->title}} {{$date}}</h3>
            <table class="table table-hover">
                <tr>
                    <th>受講ID</th>
                    <th>名前</th>
                    <th>出欠</th>
                    <th>体調</th>
                    <th>モチベーション</th>
                </tr>
                @foreach ($currentManager->training->participantsBy($user->company) as $participant)
                <tr>
                    <td>{{$participant->id}}</td>
                    <td><a href="/manager/participant/{{$participant->id}}">{{$participant->user->name}}</a></td>
                    <td>{!!$participant->getPresence($date)!!}</td>
                    <td>{!!$participant->getCondition($date)!!}</td>
                    <td>{!!$participant->getMotication($date)!!}</td>
                </tr>
                @endforeach
            </table>
            <div class="alert alert-info" role="alert">
                体調・モチベーションは4段階の自己評価です。
                ◎：良い　◯：普通　△：悪い　×：とても悪い
            </div>
            <hr>
        </div>
    </div>
  @endforeach

  @if($user->prevManagers() == null || $user->prevManagers()->count() > 0)
  <div class="row">
      <div class="col-md-12">
          <h2>過去データ</h2>
      </div>
  </div>
  @endif
  @foreach ($user->prevManagers() as $prevManager)
      <div class="row">
          <div class="col-md-6 col-md-offset-1">
              <h3>{{$prevManager->training->title}}</h3>
              <table class="table table-hover">
                  <tr>
                      <th>受講ID</th>
                      <th>名前</th>
                  </tr>
                  @foreach ($prevManager->training->participantsBy($user->company) as $participant)
                  <tr>
                      <td>{{$participant->id}}</td>
                      <td><a href="/manager/participant/{{$participant->id}}">{{$participant->user->name}}</a></td>
                  </tr>
                  @endforeach
              </table>
              <hr>
          </div>
      </div>
  @endforeach
</div>
@endif
@endsection
