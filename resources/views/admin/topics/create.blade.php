@extends('admin/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>新規お知らせ</h2>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <form action="/admin/topics" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $topic->training_id}}">

                <div class="form-group">
                    <label for="company_id">送信先企業</label>
                    <select class="form-control" name="company_id" id="companty_id">
                        @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>

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
                <a href="/admin/topics">戻る</a>
            </form>
        </div>
    </div>

</div>
@endsection
