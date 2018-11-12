@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>日報登録</h2>
        </div>
    </div>

    @include('participant/message')

    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        @if($target == 'store')
        <form action="/participant/dailyreport" method="post" enctype="multipart/form-data">
        @elseif($target == 'update')
        <form action="/participant/dailyreport/{{$dailyReport->id}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="PUT">
          <div class="row">
            <div class="col-md-6 col-md-offset-6"><table class="table table-bordered">
                <th class="text-center">確認欄（人事）</th>
                <th class="text-center">確認欄（講師）</th>
                <tr>
                  @if($dailyReport->checkedManager != null)
                    <td class="text-center">{{$dailyReport->checkedManager->name}}</td>
                  @else
                    <td class="text-center">-</td>
                  @endif
                  @if($dailyReport->checkedAdmin != null)
                    <td class="text-center">{{$dailyReport->checkedAdmin->name}}</td>
                  @else
                    <td class="text-center">-</td>
                  @endif
                </tr>
              </table>
            </div>
          </div>
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="date">日付</label>

            <input type="date" class="form-control" name="date" id="date"
                    value="{{ old('date') != null ? old('date') : $dailyReport->date }}"
                    style="width:160px">
        </div>
        <div class="form-group">
            <label for="comment">内容</label>
            <textarea class="form-control"
                    id="content"
                    name="content"
                    placeholder="内容" style="height:460px">{{ old('content') != null ? old('content') : $dailyReport->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="file">成果物（8MBまで）</label>
            @if(!is_null($dailyReport->dailyWork))
            <div>
              <a href="/participant/dailywork/file/{{$dailyReport->dailyWork->id}}">{{$dailyReport->dailyWork->file_name}}</a>
              @if(!$dailyReport->isManagerApproved())
              <button type="button" class="btn btn-xs btn-danger" aria-label="Left Align" onclick="document.workDeleteForm.submit()"><span class="glyphicon glyphicon-trash"></span></button>
              @endif
            </div>
            @endif
        </div>
        @if(is_null($dailyReport->dailyWork))
        <div class="form-group">
          <input type="file" id="file" name="file">
        </div>
        @endif

        @if($target != 'store')
          <div class="form-group">
            <label for="file">人事コメント</label>
            <div class="row">
                <div class="col-md-12">
                  @if($dailyReport->manager_comment == null)
                    @include('common/not_entered', ['item' => '人事コメント'])
                  @else
                    <div class="bs-callout bs-callout-info">
                        <pre>{{$dailyReport->manager_comment}}</pre>
                    </div>
                  @endif
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="file">講師コメント</label>
            <div class="row">
                <div class="col-md-12">
                  @if($dailyReport->admin_comment == null)
                    @include('common/not_entered', ['item' => '講師コメント'])
                  @else
                    <div class="bs-callout bs-callout-info">
                        <pre>{{$dailyReport->admin_comment}}</pre>
                    </div>
                  @endif
                </div>
            </div>
          </div>
        @endif
        @if(!$dailyReport->isManagerApproved())
        <button type="submit" class="btn btn-default">登録</button>
        @else
        担当者確認済み
        @endif
        <a href="/participant/dailyreport">戻る</a>
      </form>

      @if (!is_null($dailyReport->dailyWork) && !$dailyReport->isManagerApproved())
      <form action="/participant/dailywork/{{ $dailyReport->dailyWork->id }}" name="workDeleteForm" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
      @endif
    </div>
  </div>
</div>
@endsection
