@extends('participant/layout')

@section('content')
@if ($participant == null)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>受講状況入力</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => '受講情報'])
      </div>
    </div>
  </div>
</div>
@else
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>受講状況入力</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">出席登録</h3>
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

      <form action="/participant" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="participant_id" value="{{ $participant->id }}">
        <div class="form-group">
          <label>受講科目</label>
          <div>{{ $participant->training->title }}</div>
        </div>
        <div class="form-group">
          <label for="date">受講日</label>
          <input type="date" name="date" class="form-control"
                  id="date" style="width:160px"
                  value="{{ old('date') != null ? old('date') : Carbon\Carbon::now()->toDateString()}}">
        </div>
        <div class="form-group">
          <div><label>体調</label></div>
          <label class="radio-inline">
            <input type="radio" name="condition"
              value="4" {{ old('condition') == '4' ? 'checked="checked"' : ''}} >良い
          </label>
          <label class="radio-inline">
            <input type="radio" name="condition"
              value="3" {{ old('condition') == '3' ? 'checked="checked"' : ''}} >普通
          </label>
          <label class="radio-inline">
            <input type="radio" name="condition"
              value="2" {{ old('condition') == '2' ? 'checked="checked"' : ''}} >悪い
          </label>
          <label class="radio-inline">
            <input type="radio" name="condition"
              value="1" {{ old('condition') == '1' ? 'checked="checked"' : ''}} >とても悪い
          </label>
        </div>
        <div class="form-group">
          <div><label>モチベーション</label></div>
          <label class="radio-inline">
            <input type="radio" name="motivation"
              value="4" {{ old('motivation') == '4' ? 'checked="checked"' : ''}} >良い
          </label>
          <label class="radio-inline">
            <input type="radio" name="motivation"
              value="3" {{ old('motivation') == '3' ? 'checked="checked"' : ''}} >普通
          </label>
          <label class="radio-inline">
            <input type="radio" name="motivation"
              value="2" {{ old('motivation') == '2' ? 'checked="checked"' : ''}} >悪い
          </label>
          <label class="radio-inline">
            <input type="radio" name="motivation"
              value="1" {{ old('motivation') == '1' ? 'checked="checked"' : ''}} >とても悪い
          </label>
        </div>
        <input type="submit" class="btn btn-default" value="登録">
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">研修補足事項</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-11 col-md-offset-1">
      <ul>
        <li><a href="https://docs.google.com/a/kronos-jp.net/forms/d/1L8IydsILB2fU3y0e3pNIhvEtRXbeX7VhTnMAF4POj78/viewform" target="_blank">自習利用申請フォーム</a></li>
      </ul>
    </div>
  </div>
</div>
@endif

@endsection
