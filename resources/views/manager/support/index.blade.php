@extends('manager/layout')

@section('content')
@if ($managers == null || $managers->count() == 0)
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h2>サポート資料</h2>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
          @include('common/not_entered', ['item' => 'サポート資料'])
      </div>
    </div>
  </div>
</div>
@else

<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>サポート資料</h2>
        </div>
    </div>

@foreach ($managers as $manager)
    <div class="row">
        <div class="col-md-12">
            <h3>{{$manager->training->title}}</h3>
            <h4>研修資料</h4>

            @if ($manager->training->techSupports()->count() == 0)
            @include('common/not_entered', ['item' => '研修資料'])
            @else
            <ul>
                @foreach ($manager->training->openTechSupports() as $support)
                <li><a href="{{$support->url}}" target="_blank">{{$support->title}}</a></li>
                @endforeach
            </ul>
            @endif


            <h4>助成金資料</h4>
            @if ($manager->training->openAidSupports()->count() == 0)
            @include('common/not_entered', ['item' => '助成金資料'])
            @else
            <ul>
                @foreach ($manager->training->aidSupports() as $support)
                <li><a href="{{$support->url}}" target="_blank">{{$support->title}}</a></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
@endforeach

</div>
@endif
@endsection
