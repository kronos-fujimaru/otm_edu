<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">フィードバック入力</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
          <ul>
            <li>{{ $feedback->participant->user->company->name}}</li>
            <li>{{ $feedback->participant->user->name}}</li>
          </ul>

            @if($target == 'store')
            <form action="/admin/feedbacks" method="post">
            @else
            <form action="/admin/feedbacks/{{$feedback->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{ $feedback->participant_id}}">
                <div class="form-group">
                  <label for="title">タイトル</label>
                  <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title') != null ? old('title') : $feedback->title }}"
                    placeholder="Javaプログラミング基礎">
                </div>
                <div class="form-group">
                  <label for="date">登録日</label>
                  <input type="date" class="form-control" id="date" name="date"
                  style="width:160px"
                  value="{{ old('date') != null ? old('date') : $feedback->date }}"
                  >
                </div>
                <div class="form-group">
                  <label for="comment">コメント</label>
                  <textarea id="comment" name="comment"
                        class="form-control" style="height:200px">{{ old('comment') != null ? old('comment') : $feedback->comment }}</textarea>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/process/participants/{{$feedback->participant->id}}">キャンセル</a>
                <br> 注意：保存すると人事担当者へメールを送信します。
            </form>
        </div>
    </div>
</div>
