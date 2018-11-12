<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">受講記録登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/notes" method="post">
        @else
            <form action="/admin/notes/{{$note->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $note->training_id}}">

                <div class="form-group form-inline">
                    <label for="date">対象日</label>
                    <input type="date" class="form-control" name="date" id="date"
                        style="width:160px"
                        value="{{ old('date') != null ? old('date') : $note->date }}"
                        >
                </div>
                <div class="form-group form-inline">
                    <label for="time_from">訓練実施時間（開始）</label>
                    <input type="time" class="form-control" name="time_from" id="time_from"
                        value="{{ old('time_from') != null ? old('time_from') : $note->time_from }}"
                        >
                    <label for="time_to">訓練実施時間（終了）</label>
                    <input type="time" class="form-control" name="time_to" id="time_to"
                        value="{{ old('time_to') != null ? old('time_to') : $note->time_to }}"
                        >
                </div>
                <div class="form-group form-inline">

                    <label for="time_to">実訓練時間数</label>
                    <input type="number" class="form-control"
                        name="hours" id="hours" step="0.01"
                        value="{{ old('hours') != null ? old('hours') : $note->hours }}"
                        >
                </div>
                <div class="form-group">
                    <label for="content">実施内容</label>
                    <textarea class="form-control" style="height:200px"
                        name="content" id="content">{{ old('content') != null ? old('content') : $note->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/process/trainings/{{$note->training_id}}">キャンセル</a>
            </form>
        </div>
    </div>
</div>
