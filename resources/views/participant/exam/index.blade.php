@extends('participant/layout')

@section('content')
@if ($participant == null)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>理解度テスト</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => '受講情報'])
      </div>
    </div>
  </div>
</div>
@else
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h2>理解度テスト</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">理解度テスト一覧</h3>
  </div>
</div>
@if($participant->training->openExams()->count() == 0)
<div class="row">
    <div class="col-md-11 col-md-offset-1">
        @include('common/not_entered', ['item' => '理解度テスト一覧'])
    </div>
</div>
@else
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table">
      <tr>
        <th>実施日</th>
        <th>テスト名</th>
        <th>テスト結果</th>
      </tr>
      @foreach($participant->training->openExams() as $exam)
      <tr>
        <td>
            <a href="/participant/exam/{{$exam->id}}">
            {{ $exam->date }}
            </a>
        </td>
        <td>{{ $exam->examination->title }}</td>
        <td>{!! get_exam_link_or_score($participant, $exam) !!}</td>
        <!-- <td></td> -->
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endif

<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">理解度テスト結果</h3>
  </div>
</div>

@if($participant->examinationScores->count() == 0)
<div class="row">
    <div class="col-md-11 col-md-offset-1">
        @include('common/not_entered', ['item' => '理解度テスト結果'])
    </div>
</div>
@else
<div class="row">
  <div class="col-md-11 col-md-offset-1">
      <canvas id="glaph-score" style="height:260px;width:100%"></canvas>
    <div id="glaph-score-label"></div>
  </div>
</div>
@endif
</div>

@include('common/score_graph', ['apiUrl' => '/participant/exam/api/score'])
@endif
@endsection
