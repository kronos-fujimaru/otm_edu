@extends('participant/layout')

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
    <a href="/participant/exam">戻る</a>
@else
    <form action="/participant/exam/{{$exam->id}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="examination_training_id" value="{{$exam->id}}">
        @foreach($problems as $key=>$problem)
        <div class="row exam-problem">
            <div class="col-md-8">
                <label>問{{ $problem->no }}. {{ $problem->problem }}</label>
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
                <div class="form-group">
                    <div class="radio">
                        @foreach($problem->examinationOptions as $option)
                        <label style="width:100%;">
                            <input type="radio" name="answers[{{$problem->id}}]" value="{{$option->order}}"
                            {{ old('problem['.$key.']') == $option->order ? 'checked="checked"' : ''}} required>
                            {{ $option->order }}. {{ $option->examination_option }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <div class="row">
            <div class="col-md-8" style="margin-bottom:10px;">
                <button type="submit" class="btn btn-default">送信する</button>
                <a href="/participant/exam">キャンセル</a>
            </div>
        </div>
    </form>
@endif

</div>
@endsection
