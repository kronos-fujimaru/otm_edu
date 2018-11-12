@extends('manager/layout')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="ops-title"><a href="/manager">受講状況</a> - {{$participant->training->title}}</h2>
        </div>
    </div>

    @include('manager/message')

   <div class="row">
     <div class="col-md-4">
       <h3 class="ops-title">受講者</h3>
     </div>
   </div>

   <div class="row">
     <div class="col-md-3 col-md-offset-1">
       <table class="table table-bordered">
         <tr>
           <td class="ops-td-label">受講ID</td>
           <td>{{$participant->id}}</td>
         </tr>
         <tr>
           <td class="ops-td-label">企業名</td>
           <td>{{$participant->user->company->name}}</td>
         </tr>
         <tr>
           <td class="ops-td-label">名前</td>
           <td>{{$participant->user->name}}</td>
         </tr>
       </table>
     </div>

     <div class="row">
       <div class="col-md-12">
         <hr>
       </div>
     </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">体調・モチベーション</h3>
        </div>
    </div>
    @if($participant->cycles->count() == 0)
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            @include('common/not_entered', ['item' => '体調・モチベーション'])
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <canvas id="glaph-cycle" style="height:200px;width:100%"></canvas>
            <div id="glaph-cycle-label"></div>
        </div>
    </div>

    @include('common/cycle_graph', ['apiUrl' => "/manager/participant/api_cycle/" . $participant->id])
    @endif

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">日報</h3>
        </div>
    </div>

    @if($participant->dailyReports->count() == 0)
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            @include('common/not_entered', ['item' => '日報'])
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
          <table class="table text-center">
            <tr>
              <th class="text-center">登録日</th>
              <th class="text-center">成果物</th>
              <th class="text-center">講師確認</th>
              <th class="text-center">担当者確認</th>
              <th class="text-center">講師コメント</th>
              <th class="text-center">担当者コメント</th>
            </tr>
            {{-- */ $dailyReportPages = $participant->dailyReports()->orderBy('date', 'desc')->paginate(4, ["*"], "dailyreport") /* --}}
            @foreach($dailyReportPages as $dailyReport)
            <tr>
              <td>
                <a href="/manager/dailyreport/{{$dailyReport->id}}/edit">{{$dailyReport->date}}</a>
              </td>
              <td>
                @if($dailyReport->dailyWork == null)
                  <div class="col-md=12">
                    -
                  </div>
                @else
                  <a href="/manager/dailywork/file/{{$dailyReport->dailyWork->id}}">{{$dailyReport->dailyWork->file_name}}</a>
                @endif
              </td>
              <td>{!!$dailyReport->adminStatusString()!!}</td>
              <td>{!!$dailyReport->managerStatusString()!!}</td>
              <td>{!!$dailyReport->adminCommentStatusString()!!}</td>
              <td>{!!$dailyReport->managerCommentStatusString()!!}</td>
            </tr>
            @endforeach
          </table>
          {!! $dailyReportPages !!}
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">理解度テスト結果</h3>
        </div>
    </div>

    @if($participant->examinationScores->count() == 0)
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            @include('common/not_entered', ['item' => '理解度テスト結果'])
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <canvas id="glaph-score" style="height:200px;width:100%"></canvas>
            <div id="glaph-score-label"></div>
            <table class="table">
            <tr>
               <th>ID</th>
               <th>試験名</th>
               <th>試験日</th>
               <th>点数</th>
            </tr>
            @foreach ($participant->training->examinationTrainings as $exam)
            <tr>
                @if ($participant->hasScore($exam))
                <td>{{$exam->id}}</td>
                <td>
                    <a href="/manager/scores/{{$participant->findScoreOrFail($exam)->id}}">
                        {{$exam->examination->title}}
                    </a>
                </td>
                <td>{{$exam->date}}</td>
                <td>{{$participant->findScoreOrFail($exam)->score}}</td>
                @else
                <td>{{$exam->id}}</td>
                <td>
                    {{$exam->examination->title}}
                </td>
                <td>{{$exam->date}}</td>
                <td>未登録</td>
                @endif
            </tr>
            @endforeach
            </table>
        </div>
    </div>

    @include('common/score_graph', ['apiUrl' => "/manager/participant/api_score/" . $participant->id])
    @endif

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">連絡事項</h3>
        </div>
    </div>
    <div class="col-md-11 col-md-offset-1">
        <div class="row">
          @foreach($participant->communications as $communication)
          <div class="row">
          @if ($communication->user->isAdmin())
              <div class="col-md-10">
                  <div class="bs-callout bs-callout-info">
                      @if($communication->isNew())
                      <p><span class="label label-danger">new</span></p>
                      @endif
                      <p>
                      <pre>{{$communication->comment}}</pre>
                      </p>
                  </div>
                  <div>{{$communication->user->company->name}}：{{$communication->user->name}} {{$communication->created_at}}
                  </div>
              </div>
          </div>
          @else
             <div class="col-md-10">
                <div class="bs-callout bs-callout-warning">
                    @if($communication->isNew())
                    <p><span class="label label-danger">new</span></p>
                    @endif
                    <p>
                    <pre>{{$communication->comment}}</pre>
                    </p>
                </div>
                <div>{{$communication->user->company->name}}：{{$communication->user->name}} {{$communication->created_at}}
                </div>
            </div>
          </div>
          @endif
          @endforeach
          @if($participant->communications->count() == 0)
              @include('common/not_entered', ['item' => '連絡事項'])
          @endif
          <a href="/manager/communications/create?participant_id={{$participant->id}}" class="btn btn-default">新規作成</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">受講生の振り返り</h3>
        </div>
    </div>
    @if($participant->getDateTabYM()->count() == 0)
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            @include('common/not_entered', ['item' => '振り返り'])
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
            @foreach ($participant->getDateTabYM() as $dateYM)
                <li class="{{$dateYM == $participant->getDateTabYM()->first() ? 'active' : ''}}">
                    <a href="#{{$dateYM}}" data-toggle="tab">{{$dateYM}}</a>
                </li>
            @endforeach
            </ul>
            <div class="tab-content">
                @foreach ($participant->getReportContentYM() as $dateYM => $reportsYM)
                <div class="tab-pane {{$dateYM == $participant->getReportContentYM()->keys()->first() ? 'active' : ''}}" id="{{$dateYM}}">
                    @foreach ($reportsYM as $report)
                    <div class="bs-callout bs-callout-info" id="callout-buttons-anchor-accessibility">
                        <h4>
                            {{$report->analysis->theme}}
                        </h4>
                        <p>登録日 {{$report->date}}</p>
                        <p>
                            <pre>{{$report->content}}</pre>
                        </p>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
       </div>
     </div>
     @endif
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    @include('common/raiting_graph')

    <div class="row">
        <div class="col-md-4">
            <h3 class="ops-title">総合評価</h3>
        </div>
    </div>
    <div class="row">
        {{-- */ $raitingPages = $participant->raitings()->orderBy('id', 'desc')->paginate(1, ["*"], "raiting") /* --}}
        @foreach($raitingPages as $raiting)
        <div class="col-md-5 col-md-offset-1">
            <div class="row">
                <label style="font-size:20px;word-break: break-all;">{{$raiting->title}}</label>
                <span class="ops-annotation">（最終更新日時：{{$raiting->updated_at->format("Y-m-d H:i")}}）</span>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td class="ops-td-label" width="60px">Java</td>
                    <td width="35px">{{$raiting->skill_a}}</td>
                    <td style="word-break: break-all;">{{$raiting->skill_a_comment}}</td>
                </tr>
                <tr>
                    <td class="ops-td-label">Web</td>
                    <td>{{$raiting->skill_b}}</td>
                    <td style="word-break: break-all;">{{$raiting->skill_b_comment}}</td>
                </tr>
                <tr>
                    <td class="ops-td-label">DB</td>
                    <td>{{$raiting->skill_c}}</td>
                    <td style="word-break: break-all;">{{$raiting->skill_c_comment}}</td>
                </tr>
                <tr>
                    <td class="ops-td-label">積極性</td>
                    <td>{{$raiting->skill_d}}</td>
                    <td style="word-break: break-all;">{{$raiting->skill_d_comment}}</td>
                </tr>
                <tr>
                    <td class="ops-td-label">徹底性</td>
                    <td>{{$raiting->skill_e}}</td>
                    <td style="word-break: break-all;">{{$raiting->skill_e_comment}}</td>
                </tr>
                <tr>
                    <td class="ops-td-label">誠実さ</td>
                    <td>{{$raiting->skill_f}}</td>
                    <td style="word-break: break-all;">{{$raiting->skill_f_comment}}</td>
                </tr>
                <tr>
                    <td class="ops-td-label">総合</td>
                    <td colspan="2" style="word-break: break-all;">{{$raiting->comment}}</td>
                </tr>
            </table>
            <div class="row">
            <div class="col-md-6">{!! $raitingPages->appends(["dailyreport"=>Input::get('dailyreport')]) !!}</div>
            </div>
        </div>
        <div class="col-md-5">
            <div id="data-raiting"
                data-my-skill-a="{{$raiting->skill_a}}"
                data-my-skill-b="{{$raiting->skill_b}}"
                data-my-skill-c="{{$raiting->skill_c}}"
                data-my-skill-d="{{$raiting->skill_d}}"
                data-my-skill-e="{{$raiting->skill_e}}"
                data-my-skill-f="{{$raiting->skill_f}}" >
            </div>
            <canvas id="glaph-raiting" style="height:280px;width:100%"></canvas>
        </div>
        @endforeach
        @if($participant->raitings->count() == 0)
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                @include('common/not_entered', ['item' => '総合評価'])
            </div>
        </div>
        @endif

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

    @if($participant->myNotes()->count() == 0)
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            @include('common/not_entered', ['item' => '受講記録'])
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <table class="table table-bordered">
                <tr>
                    <td class="ops-td-label">実訓練時間数の合計</td>
                    <td>{{$participant->training->totalHoursBy($participant)}} 時間</td>
                </tr>
                <tr>
                  <td class="ops-td-label">受講時間数の合計</td>
                  <td>{{$participant->training->totalActualHours($participant)}} 時間</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table table-striped ops-notes">
                <tr>
                    <th class="ops-notes-date">実施日</th>
                    <th class="ops-notes-type">出席状況</th>
                    <th class="ops-notes-hours">訓練実施時間帯<br>うち除外時間数<br>実訓練時間数</th>
                    <th class="ops-notes-actual-hours">受講時間数</th>
                    <th class="ops-notes-content">実施内容</th>
                </tr>
                @foreach ($participant->myNotes() as $myNote)
                <tr>
                    <td>{{$myNote['date']}}</td>
                    <td>{!! $myNote['type']!!}</td>
                    <td>{{$myNote['exam_time']}}<br>{{$myNote['exam_exclude_hours']}}<br>{{$myNote['exam_actual_hours']}}</td>
                    <td>{{$myNote['actual_hours']}}</td>
                    <td>{!!newline_to_break($myNote['content'])!!}</td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
    @endif
</div>

<script>
$(function(){
    $('[data-toggle="tooltip"]').tooltip()
});

</script>
@endsection
