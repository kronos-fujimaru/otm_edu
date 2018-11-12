<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2 class="ops-title">講師詳細</h2>
    </div>
  </div>

  @include('admin/message')

  <div class="row">
    <div class="col-md-12">
      <h3>講師詳細情報</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
        @if($target == 'store')
        <form action="/admin/instructors" method="post" enctype="multipart/form-data">
        @else
        <form action="/admin/instructors/{{$instructor->id}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
        @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" name="name" class="form-control" id="name"
                      value="{{ old('name') != null ? old('name') : $instructor->name }}" placeholder="講師名">
            </div>
            <div class="form-group">
              <label for="icon">画像</label>
              <input type="file" name="icon" class="form-control" id="icon">
            </div>
            <div>
              @if($instructor->icon_url != null && $instructor->icon_url != "")
                <img src="{{ $instructor->icon_url}}">
              @endif
            </div>
            <button type="submit" class="btn btn-default">保存</button>
            <a href="/admin/instructors">戻る</a>
        </form>
    </div>
  </div>
</div>
