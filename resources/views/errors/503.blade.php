@extends('auth/layout')

@section('content')
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h3>しばらく待ってからアクセスしてください。</h3>
      <a href="/auth/logout">ログイン画面へ戻る</a>
    </div>
  </div>
</div>
@endsection
