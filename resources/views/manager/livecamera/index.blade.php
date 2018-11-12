@extends('manager/layout')

@section('content')

@if ($videourl == null)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>ライブ配信</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => 'ライブ配信'])
      </div>
    </div>
  </div>
</div>
@else
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3>ライブ配信 {{$manager->training->title}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <iframe id="ustream" src="{{$videourl}}" style="border: 0 none transparent;"  webkitallowfullscreen allowfullscreen frameborder="no" width="720" height="405"></iframe>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>動画再生用パスワード：{{$manager->training->videourl->url_password}}</h4>
        </div>
    </div>
    @foreach($managers as $othermanager)
    <div class="row">
        <div class="col-md-12">
            <a href="/manager/livecamera/{{$othermanager->training_id}}">{{$othermanager->training->title}}はこちら</a>
        </div>
    </div>
    @endforeach
    <!-- <script src="/js/test.js"></script> -->

@endif
@endsection
