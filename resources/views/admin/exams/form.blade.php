<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">理解度テスト登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/exams" method="post">
        @else
            <form action="/admin/exams/{{$examinationTraining->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $examinationTraining->training_id}}">

                <div class="form-group">
                    <label for="title">テスト名</label>
                    <select class="form-control" style="width:320px" name="examination_id" id="examination_id">
                    @foreach($examinations as $examination)
                        <option value="{{$examination->id}}" {{ $examinationTraining->examination != null && $examinationTraining->examination->id == $examination->id ? 'selected':'' }} >
                            {{$examination->title}}
                        </option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">実施日</label>
                    <input type="date" class="form-control" name="date" id="date"
                            value="{{ old('date') != null ? old('date') : $examinationTraining->date }}"
                            style="width:160px">
                </div>
                <div class="form-group form-inline">
                    <label for="status0">ステータス</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status0"
                             value="{{\App\ExaminationTraining::STATUS_BEFORE}}"
                             {{ old('status') == strval(\App\ExaminationTraining::STATUS_BEFORE) ||  $examinationTraining->status == \App\ExaminationTraining::STATUS_BEFORE ? 'checked="checked"' : ''}}
                             >
                            公開前（非公開）
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status1"
                             value="{{\App\ExaminationTraining::STATUS_OPEN}}"
                             {{ old('status') == strval(\App\ExaminationTraining::STATUS_OPEN) ||  $examinationTraining->status == \App\ExaminationTraining::STATUS_OPEN ? 'checked="checked"' : ''}}
                             >
                             公開中
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status2"
                            value="{{\App\ExaminationTraining::STATUS_AFTER}}"
                            {{ old('status') == strval(\App\ExaminationTraining::STATUS_AFTER) ||  $examinationTraining->status == \App\ExaminationTraining::STATUS_AFTER ? 'checked="checked"' : ''}}
                            >
                            公開終了
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/trainings/{{$examinationTraining->training_id}}/edit">キャンセル</a>
            </form>
        </div>
    </div>
</div>
