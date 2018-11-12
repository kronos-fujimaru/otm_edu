@extends('admin/layout')

@section('content')

<div class="container ops-main">

    <div class="row">
      <div class="col-md-12">
        <h2 class="ops-title">研修状況 - {{$training->title}}</h2>
      </div>
    </div>

    @include('admin/message')

    <div class="row">
      <div class="col-md-12">
        <h3 class="ops-title">受講者一覧</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>名前</th>
            <th>所属企業</th>
          </tr>
          @foreach ($training->participants()->withTrashed()->get() as $participant)
          <tr>
            <td>{{$participant->id}}</td>
            <td>
                <a href="/admin/process/participants/{{$participant->id}}">
                    {{$participant->user->name}}
                </a>
            </td>
            <td>{{$participant->user->company->name}}</td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <hr>
      </div>
    </div>


    <div class="row">
       <div class="col-md-12">
         <h3 class="ops-title">受講記録</h3>
       </div>
     </div>

     <div class="row">
       <div class="col-md-3 col-md-offset-1">
         <table class="table table-bordered">
           <tr>
             <td class="ops-td-label">実訓練時間数の合計</td>
             <td>{{$training->totalHours()}} 時間</td>
           </tr>
         </table>
       </div>
     </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-striped">
                <tr>
                    <th>実施日</th>
                    <th width="120px">訓練実施時間帯</th>
                    <th width="120px">実訓練時間数</th>
                    <th>実施内容</th>
                    <th>削除</th>
                </tr>

                @foreach ($training->notes()->orderby('date')->get() as $note)
                <tr>
                    <td>
                        <a href="/admin/notes/{{$note->id}}/edit">
                            {{$note->date}}
                        </a>
                    </td>
                    <td>{{get_time_label($note)}}</td>
                    <td>{{$note->hours}} 時間</td>
                    <td>
                        {!!newline_to_break($note->content)!!}
                    </td>
                    <td>
                        <form action="/admin/notes/{{$note->id}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <a href="/admin/notes/create?training_id={{$training->id}}" class="btn btn-default">新規作成</a>
            </div>
        </div>
    </div>
</div>
@endsection
