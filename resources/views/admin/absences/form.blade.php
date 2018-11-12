<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">欠席・遅刻・早退記録入力</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
            <form action="/admin/absences" method="post">
            @else
            <form action="/admin/absences/{{$absence->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{ $absence->participant_id}}">


                <div class="form-group form-inline">
                  <label for="exampleInputPassword1">対象日</label>
                  <input type="date" class="form-control"
                      id="date" name="date"
                      style="width:160px"
                      value="{{ old('date') != null ? old('date') : $absence->date }}"
                  >
                  <label for="hours">受講時間数</label>
                  <input type="text" class="form-control"
                        id="hours" name="hours"
                        value="{{ old('hours') != null ? old('hours') : $absence->hours }}"
                        >
                </div>

                <div class="form-group">
                  <label for="type">区分</label>
                  <select class="form-control" style="width:320px"
                    id="type" name="type">
                    <option
                        value="{{$absence::TYPE_ABSENCE}}"
                        @if($absence->type == $absence::TYPE_ABSENCE)
                        selected
                        @endif
                    >欠席
                    </option>
                    <option
                        value="{{$absence::TYPE_LATE}}"
                        @if($absence->type == $absence::TYPE_LATE)
                        selected
                        @endif
                    >遅刻
                    </option>
                    <option
                        value="{{$absence::TYPE_EARLY}}"
                        @if($absence->type == $absence::TYPE_EARLY)
                        selected
                        @endif
                    >早退
                    </option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="reason">詳細・理由</label>
                  <input type="text" class="form-control"
                    id="reason" name="reason" placeholder="09:00-12:00まで受講" value="{{ old('reason') != null ? old('reason') : $absence->reason }}">
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/process/participants/{{$absence->participant_id}}">キャンセル</a>

            </form>
        </div>
    </div>
</div>
