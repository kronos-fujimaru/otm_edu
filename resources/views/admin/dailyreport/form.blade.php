@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>日報確認</h2>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        <form action="/admin/dailyreport/{{$dailyReport->id}}" method="post">
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

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="date">日付</label>
            <div>
              {{$dailyReport->date}}
            </div>
        </div>
        <div class="form-group">
            <label for="comment">内容</label>
            <div class="bs-callout bs-callout-info">
                <pre>{{$dailyReport->content}}</pre>
            </div>
        </div>
        <div class="form-group">
            <label for="file">成果物</label>
            <div>
              @if (!is_null($dailyReport->dailyWork))
              <a href="/admin/dailywork/file/{{$dailyReport->dailyWork->id}}">{{$dailyReport->dailyWork->file_name}}</a>
              @else
                なし
              @endif
            </div>
        </div>

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
                  <textarea class="form-control"
                          id="admin_comment"
                          name="admin_comment"
                          placeholder="コメント" style="height:160px">{{ old('admin_comment') != null ? old('admin_comment') : $dailyReport->admin_comment }}</textarea>
              </div>
            </div>
          </div>
        @endif
        <button type="submit" class="btn btn-default" name="approve" value="approve">確認済みにする</button>
        <button type="submit" class="btn btn-danger" name="reject" value="reject">再提出</button>
        <a href="/admin/process/participants/{{$dailyReport->participant_id}}">戻る</a>
      </form>
    </div>
  </div>
</div>
@endsection
