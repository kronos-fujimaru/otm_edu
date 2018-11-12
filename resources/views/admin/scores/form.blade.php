<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">理解度テスト結果登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
        @if($target == 'store')
            <form action="/admin/scores" method="post">
        @else
            <form action="/admin/scores/{{$score->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{ $score->participant_id}}">
                <input type="hidden" name="exam_id" value="{{ $score->exam_id}}">

                <div class="form-group">
                  <label for="exampleInputPassword1">受講者名</label>
                  <p>{{$score->participant->user->name}}</p>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">テスト名</label>
                  <p>{{$score->exam->title}}</p>
                </div>
                <div class="form-group form-inline">
                    <label for="point">点数</label>
                    <input type="number" class="form-control" name="point" id="point"
                        value="{{ old('point') != null ? old('point') : $score->point }}"
                        >
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/process/participants/{{$score->participant->id}}">キャンセル</a>
            </form>
        </div>
    </div>
</div>
