<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">サポート資料登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/supports" method="post">
        @else
            <form action="/admin/supports/{{$support->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $support->training_id}}">

                <div class="form-group">
                    <label for="title">サポート資料名</label>
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ old('title') != null ? old('title') : $support->title }}"
                        placeholder="サポート資料">
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" class="form-control" name="url" id="url"
                        value="{{ old('url') != null ? old('url') : $support->url }}"
                        placeholder="http://www.kronos-jp.net/">
                </div>
                <div class="form-group form-inline">
                    <label for="status0">ステータス</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status0"
                             value="{{\App\support::STATUS_BEFORE}}"
                             {{ old('status') == strval(\App\support::STATUS_BEFORE) ||  $support->status == \App\support::STATUS_BEFORE ? 'checked' : ''}}
                             >
                            公開前（非公開）
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status1"
                             value="{{\App\support::STATUS_OPEN}}"
                             {{ old('status') == strval(\App\support::STATUS_OPEN) ||  $support->status == \App\support::STATUS_OPEN ? 'checked' : ''}}
                             >
                             公開中
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status2"
                            value="{{\App\support::STATUS_AFTER}}"
                            {{ old('status') == strval(\App\support::STATUS_AFTER) ||  $support->status == \App\support::STATUS_AFTER ? 'checked' : ''}}
                            >
                            公開終了
                        </label>
                    </div>
                </div>

                <div class="form-group form-inline">
                    <label for="type0">種別</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="type" id="type0"
                             value="{{\App\support::TYPE_TECH}}"
                             {{ old('type') == strval(\App\support::TYPE_TECH) ||  $support->type == \App\support::TYPE_TECH ? 'checked' : ''}}
                             >
                            研修資料
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="type" id="type1"
                             value="{{\App\support::TYPE_AID}}"
                             {{ old('type') == strval(\App\support::TYPE_AID) ||  $support->type == \App\support::TYPE_AID ? 'checked' : ''}}
                             >
                             助成金資料
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/trainings/{{$support->training_id}}/edit">キャンセル</a>
            </form>
        </div>
    </div>
</div>
