<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <form action="/admin/messages" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="topic_id" value="{{ $topic->id}}">
            <div class="form-group">
                <label for="comment">返信</label>
                <textarea class="form-control"
                        id="comment"
                        name="comment"
                        placeholder="返信" style="height:160px">{{ old('comment') != null ? old('comment') : "" }}</textarea>
            </div>
            <div class="form-group">
                <label for="file">添付ファイル（10MBまで）</label>
                <input type="file" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-default">登録</button>
            <a href="/admin/topics">戻る</a>
        </form>
    </div>
</div>
