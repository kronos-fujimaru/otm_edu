@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>理解度テスト登録</h2>
        </div>
    </div>

    @include('participant/message')

    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        @if($target == 'store')
        <form action="/admin/examinations" method="post">
        @elseif($target == 'update')
        <form action="/admin/examinations/{{$examination->id}}" method="post">
          <input type="hidden" name="_method" value="PUT">
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="date">タイトル</label>

            <input type="text" class="form-control" name="title" id="title"
                    value="{{ old('title') != null ? old('title') : $examination->title }}">
        </div>

        @foreach($examination->examinationProblems as $problem)
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="form-group">
            <label for="date">問{{$problem->no}}</label>
            <input type="text" class="form-control" name="problem{{$problem->no}}" id="problem{{$problem->no}}"
                    value='{{ old("problem$problem->no") != null ? old("problem$problem->no") : $problem->problem }}'>
        </div>
        <div class="form-group">
            <label for="date">ソースコード（Markdown記法で記述してください）</label>
            <textarea class="form-control"
                  id="source{{$problem->no}}"
                  name="source{{$problem->no}}"
                  style="height:160px;">{{ old("source$problem->no") != null ? old("source$problem->no") : $problem->source }}</textarea>
            <div id="preview{{$problem->no}}"></div>
            <script>
            var prev = function prev() {
                var html = marked($("#source{{$problem->no}}").val());
                $("#preview{{$problem->no}}").html(html);
                $("#preview{{$problem->no}} pre code").each(function(i, e) {
                    hljs.highlightBlock(e, e.className);
                });
            }

            prev();

            $("#source{{$problem->no}}").keyup(prev);
            </script>
        </div>
              <label>選択肢</label>
                @foreach($problem->examinationOptions as $option)
                <div class="form-group form-inline">
                    <input type="radio" name="answer{{$problem->no}}" value="{{$option->order}}"
                        {{ old("answer$problem->no") != $option->order ? ($problem->answer == $option->order ? 'checked="checked"' : '') : 'checked="checked"'}} >
                    <input type="text" class="form-control" name="option{{$problem->no}}{{$option->order}}" id="option{{$problem->no}}{{$option->order}}"
                            value='{{ old("option$problem->no$option->order") != null ? old("option$problem->no$option->order") : $option->examination_option}}'
                            style="width:70%">
                </div>
                @endforeach
        @endforeach
        @if($examination->examinationTrainings->count() < 1)
          <button type="submit" class="btn btn-default">登録</button>
        @else
          研修登録済み
        @endif
        <a href="/admin/examinations">戻る</a>
      </form>
    </div>
  </div>
</div>
@endsection
