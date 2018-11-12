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
    <h2>アンケート</h2>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">アンケート一覧</h3>
  </div>
</div>

@if($participant->training->openQuestions()->count() == 0)
<div class="row">
    <div class="col-md-11 col-md-offset-1">
        @include('common/not_entered', ['item' => 'アンケート一覧'])
    </div>
</div>
@else
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table">
      <tr>
        <th>実施日</th>
        <th>アンケート名</th>
        <th><br></th>
      </tr>
      @foreach($participant->training->openQuestions() as $question)
      <tr>
        <td>{{ $question->date }}</td>
        <td>{{ $question->title }}</td>
        <td>{!! get_question_link($question) !!}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endif
</div>
@endif
@endsection
