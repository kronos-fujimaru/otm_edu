<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>設定</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">メールアドレス変更</h3>
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


      <form action="/{{$functionName}}/setting/email" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="date">メールアドレス</label>
          <input type="email" name="email" class="form-control"
                  value="{{ old('email') != null ? old('email') : Auth::user()->email }}"
                   style="width:400px">
        </div>

        <input type="submit" class="btn btn-default" value="登録">
      </form>
    </div>
  </div>
</div>
