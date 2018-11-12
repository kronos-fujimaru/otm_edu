<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">テーマ入力</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/analysis" method="post">
        @else
            <form action="/admin/analysis/{{$analysis->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="analysis_id" value="{{ $analysis->id}}">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="theme">テーマ</label>
                    <input type="text" class="form-control" name="theme" id="theme"
                        value="{{ old('theme') != null ? old('theme') : $analysis->theme }}"
                        placeholder="テーマを入力してください"
                        {{ $analysis->reports->count() > 0 ? "readonly='readonly'":"" }}>
                </div>
                <div class="form-group">
                    <label for="date">実施日</label>
                    <input type="date" class="form-control" name="date" id="date"
                            value="{{ old('date') != null ? old('date') : $analysis->date }}"
                            style="width:160px">
                </div>
                <div class="form-group form-inline">
                    <label for="status0">ステータス</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status0"
                             value="{{\App\Analysis::STATUS_BEFORE}}"
                             {{ old('status') == strval(\App\Analysis::STATUS_BEFORE) ||  $analysis->status == \App\Analysis::STATUS_BEFORE ? 'checked="checked"' : ''}}
                             >
                            公開前（非公開）
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status1"
                            value="{{\App\Analysis::STATUS_OPEN}}"
                            {{ old('status') == strval(\App\Analysis::STATUS_OPEN) ||  $analysis->status == \App\Analysis::STATUS_OPEN ? 'checked="checked"' : ''}}
                             >
                             公開中
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status2"
                            value="{{\App\Analysis::STATUS_AFTER}}"
                            {{ old('status') == strval(\App\Analysis::STATUS_AFTER) ||  $analysis->status == \App\Analysis::STATUS_AFTER ? 'checked="checked"' : ''}}
                            >
                            公開終了
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/analysis/">キャンセル</a>
                <br>
                <span>※受講者が回答しているテーマの変更はできません。</span>
            </form>
        </div>
    </div>
</div>
