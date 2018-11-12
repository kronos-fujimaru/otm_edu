@extends('manager/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>新規問い合わせ</h2>
        </div>
    </div>

    @include('manager/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <form action="/manager/topics" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control"
                            id="title" name="title"
                            placeholder="タイトル"
                            value="{{ old('title') != null ? old('title') : $topic->title }}"
                            >
                </div>
                <div class="form-group">
                    <label for="comment">本文</label>
                    <textarea class="form-control"
                            id="comment"
                            name="comment"
                            placeholder="本文" style="height:160px">{{ old('comment') != null ? old('comment') : $topic->comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="file">添付ファイル（10MBまで）</label>
                    <input type="file" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/manager/topics">戻る</a>
            </form>
        </div>
    </div>

</div>
@endsection
