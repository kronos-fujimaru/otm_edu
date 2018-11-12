<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">アンケート登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/questions" method="post">
        @else
            <form action="/admin/questions/{{$question->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $question->training_id}}">

                <div class="form-group">
                    <label for="title">アンケート名</label>
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ old('title') != null ? old('title') : $question->title }}"
                        placeholder="理解度テスト1">
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" class="form-control" name="url" id="url"
                        value="{{ old('url') != null ? old('url') : $question->url }}"
                        placeholder="http://www.kronos-jp.net/">
                </div>
                <div class="form-group">
                    <label for="date">実施日</label>
                    <input type="date" class="form-control" name="date" id="date"
                            value="{{ old('date') != null ? old('date') : $question->date }}"
                            style="width:160px">
                </div>
                <div class="form-group form-inline">
                    <label for="status0">ステータス</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status0"
                             value="{{\App\question::STATUS_BEFORE}}"
                             {{ old('status') == strval(\App\question::STATUS_BEFORE) ||  $question->status == \App\question::STATUS_BEFORE ? 'checked="checked"' : ''}}
                             >
                            公開前（非公開）
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status1"
                             value="{{\App\question::STATUS_OPEN}}"
                             {{ old('status') == strval(\App\question::STATUS_OPEN) ||  $question->status == \App\question::STATUS_OPEN ? 'checked="checked"' : ''}}
                             >
                             公開中
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status2"
                            value="{{\App\question::STATUS_AFTER}}"
                            {{ old('status') == strval(\App\question::STATUS_AFTER) ||  $question->status == \App\question::STATUS_AFTER ? 'checked="checked"' : ''}}
                            >
                            公開終了
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/trainings/{{$question->training_id}}/edit">キャンセル</a>
            </form>
        </div>
    </div>
</div>
