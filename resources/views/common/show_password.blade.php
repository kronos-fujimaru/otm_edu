<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>設定</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">パスワード変更</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-11 col-md-offset-1">

      @if (Session::has('flash_message'))
          <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action="/{{$functionName}}/setting/password" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="date">パスワード</label>
          <input type="password" name="password1" class="form-control"
                  value="" style="width:400px">
        </div>
        <div class="form-group">
          <label for="date">パスワード（確認用）</label>
          <input type="password" name="password2" class="form-control"
                  value="" style="width:400px">
        </div>
        <input type="submit" class="btn btn-default" value="登録">
      </form>
    </div>
  </div>
</div>
