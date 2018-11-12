<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="ops-title">研修詳細</h2>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-12">
            <h3>研修詳細情報</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
        @if($target == 'store')
            <form action="/admin/trainings" method="post">
        @else
            <form action="/admin/trainings/{{$training->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="title">研修タイトル</label>
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ old('title') != null ? old('title') : $training->title }}"
                    placeholder="Javaプログラミング研修"
                    >
                </div>
                <div class="form-group">
                    <label for="place">開催地</label>
                    <input type="text" class="form-control" name="place" id="place"
                        value="{{ old('place') != null ? old('place') : $training->place }}"
                        placeholder="大阪事務所">
                </div>
                <div class="form-group form-inline">
                    <label for="date_from">開催期間（開始）</label>
                    <input type="date" class="form-control" name="date_from" id="date_from"
                        value="{{ old('date_from') != null ? old('date_from') : $training->date_from }}"
                        >
                    <label for="date_to">開催期間（終了）</label>
                    <input type="date" class="form-control" name="date_to" id="date_to"
                        value="{{ old('date_to') != null ? old('date_to') : $training->date_to }}"
                        >
                </div>
                <div class="form-group">
                    <label for="instructor_id">講師</label>
                    <select class="form-control" style="width:320px" name="instructor_id" id="instructor_id">
                    @foreach($instructors as $instructor)
                        @if($training->instructor != null && $training->instructor->id == $instructor->id)
                            <option value="{{$instructor->id}}" selected>
                                {{$instructor->name}}
                            </option>
                        @@else
                            <option value="{{$instructor->id}}">
                                {{$instructor->name}}
                            </option>
                        @endif
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="videourl_id">動画配信ユーザID</label>
                    <select class="form-control" style="width:320px" name="videourl_id" id="videourl_id">
                    @foreach($videourls as $videourl)
                        @if($training->videourl != null && $training->videourl->id == $videourl->id)
                            <option value="{{$videourl->id}}" selected>
                                {{$videourl->url_user_id}}
                            </option>
                        @@else
                            <option value="{{$videourl->id}}">
                                {{$videourl->url_user_id}}
                            </option>
                        @endif
                    @endforeach
                    </select>
                </div>

                <div class="form-group form-inline">
                    <label for="status1">ステータス</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status0"
                                value="0"
                                {{ old('status') == '0' ||  $training->status == 0 ? 'checked="checked"' : ''}}
                                >公開前（非公開）
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status1"
                                value="1"
                                {{ old('status') == '1' ||  $training->status == 1 ? 'checked="checked"' : ''}}
                                >公開中
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status2"
                                value="2"
                                {{ old('status') == '2' ||  $training->status == 2 ? 'checked="checked"' : ''}}
                                >公開終了
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/trainings">キャンセル</a>
            </form>
        </div>
    </div>
</div>
