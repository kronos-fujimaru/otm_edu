<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">振り返り登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/participant/report" method="post">
        @else
            <form action="/participant/report/{{$report->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{$report->participant_id}}">
                <input type="hidden" name="date" value="{{$report->date}}">
                <div class="form-group">
                    <label for="theme">テーマ</label>
                    <select name="analysis_id" id="theme" class="form-control" style="width:320px" >
                    @foreach ($analyses as $analysis)
                        @if($report->analysis != null && $report->analysis->id == $analysis->id)
                        <option value="{{$analysis->id}}" selected>
                            {{$analysis->theme}}
                        </option>
                        @else
                        <option value="{{$analysis->id}}">
                            {{$analysis->theme}}
                        </option>
                        @endif
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea id="content" name="content"
                          class="form-control" style="height:500px">{{ old('content') != null ? old('content') : $report->content }}</textarea>
                </div>
                <p>※１ヶ月の研修を通して、うまくいったことや課題に感じていること、研修前と比べてどのような変化があったかなど。(800文字以上)
</p>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/participant/report/">キャンセル</a>
            </form>
        </div>
    </div>
</div>
