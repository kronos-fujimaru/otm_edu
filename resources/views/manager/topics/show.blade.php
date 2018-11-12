@extends('manager/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2>件名：{{$topic->title}}</h2>
        </div>
    </div>

    @include('manager/message')

    <div class="row">
        @if ($topic->user->isAdmin())
        <div class="col-md-8 col-md-offset-3">
           <div class="bs-callout bs-callout-info">
               <pre>{{$topic->comment}}</pre>
           </div>
           @if (!is_null($topic->file_name))
           <div>添付ファイル：<a  href="/manager/topics/file/{{$topic->id}}">{{$topic->file_name}}</a>
           </div>
           @endif
           <div>{{$topic->user->company->name}}：{{$topic->user->name}} {{$topic->created_at}}
           </div>
        </div>
        @else
        <div class="col-md-8 col-md-offset-1">
           <div class="bs-callout bs-callout-warning">
               <pre>{{$topic->comment}}</pre>
           </div>
           @if (!is_null($topic->file_name))
           <div>添付ファイル：<a  href="/manager/topics/file/{{$topic->id}}">{{$topic->file_name}}</a>
           </div>
           @endif
           <div>{{$topic->user->company->name}}：{{$topic->user->name}} {{$topic->created_at}}
           </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

@foreach ($topic->messages as $message)
    @if ($message->user->isAdmin())
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
           <div class="bs-callout bs-callout-info">
               <pre>{{$message->comment}}</pre>
           </div>
           @if (!is_null($message->file_name))
           <div>添付ファイル：<a  href="/manager/messages/file/{{$message->id}}">{{$message->file_name}}</a>
           </div>
           @endif
           <p>{{$message->user->company->name}}：{{$message->user->name}} {{$message->created_at}}
           </p>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
           <div class="bs-callout bs-callout-warning">
               <pre>{{$message->comment}}</pre>
           </div>
           @if (!is_null($message->file_name))
           <div>添付ファイル：<a  href="/manager/messages/file/{{$message->id}}">{{$message->file_name}}</a>
           </div>
           @endif
           <div>{{$message->user->company->name}}：{{$message->user->name}} {{$message->created_at}}
               <form action="/manager/messages/{{ $message->id }}" method="post" style="display:inline">
                 <input type="hidden" name="_method" value="DELETE">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
               </form>
           </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
@endforeach

    @include('manager/messages/form')

</div>
@endsection
