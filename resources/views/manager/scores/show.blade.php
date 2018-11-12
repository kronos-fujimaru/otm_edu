@extends('manager/layout')

@section('content')

<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">理解度テスト（{{ $exam->examination->title }}）</h3>
  </div>
</div>

@if($score != null)
    <div class="row">
        <div class="col-md-8">
            <h4>得点 {{ $score->score }}</h4>
        </div>
    </div>
    @foreach($problems as $problem)
    <div class="row exam-problem">
        <div class="col-md-8">
            <div class="form-group {{ $score->answerBy($problem)->answer == $problem->answer ? 'bg-success' :'bg-danger'}}">
                <label>問{{ $problem->no }}. {{ $problem->problem }}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <label>正解 {{ $problem->answer }}</label>
        </div>
    </div>

    <div class="row exam-problem">
        <div class="col-md-8">
            <div class="markdown">{{ $problem->source }}</div>
        </div>
    </div>

    @if($problem->examinationOptions != null)
    <div class="row">
        <div class="col-md-7">
            <div class="radio" >
                @foreach($problem->examinationOptions as $option)
                <label style="width:100%;"><input type="radio" name="problem_{{$problem->id}}" value="1"
                    disabled
                    {{ $score->answerBy($problem)->answer == $option->order ? 'checked' : ''}}>{{ $option->order }}. {{ $option->examination_option }}
                </label>
                @endforeach
            </div>

        </div>
    </div>
    @endif

    @endforeach
    <a href="/manager/participant/{{$participantId}}">戻る</a>
@endif

</div>
@endsection
