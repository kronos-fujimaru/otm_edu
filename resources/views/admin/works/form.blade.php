<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">成果物入力</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

            @if($target == 'store')
            <form action="/admin/works" method="post" enctype="multipart/form-data">
            @else
            <form action="/admin/works/{{$work->id}}" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{ $work->participant_id}}">

                <div class="form-group">
                  <label for="date">登録日</label>
                  <input type="date" class="form-control" id="date" name="date"
                   style="width:160px"
                   value="{{ old('date') != null ? old('date') : $work->date }}"
                   >
                </div>

            @if($target == 'update')
                <div class="form-group">
                  <label for="file">既存ファイル</label>
                  <p><a href="{{$work->file_url}}">{{$work->file_name}}</a></p>
                </div>
            @endif

                <div class="form-group">
                  <label for="file">新規ファイル</label>
                  <input type="file" class="form-control" id="file" name="file" style="width:300px">
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/process/participants/{{$work->participant->id}}">キャンセル</a>
            </form>
        </div>
    </div>
</div>
