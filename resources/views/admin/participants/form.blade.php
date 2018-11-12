@if($target == 'store')
<div id="ops-participant" class="container ops-main">
@else
<div id="ops-participant" class="container ops-main"
    data-participant-id="{{$participant->user->id}}">
@endif
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">受講者登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/participants" method="post">
        @else
            <form action="/admin/participants/{{$participant->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $participant->training_id}}">
                <div class="form-group">
                    <label for="company_id">受講企業名</label>
                    <select name="company_id" id="company_id" class="form-control" style="width:320px" >
                    @foreach ($companies as $company)
                        @if($participant->user != null && $company->id == $participant->user->company->id)
                        <option value="{{$company->id}}" selected>
                            {{$company->name}}
                        </option>
                        @else
                        <option value="{{$company->id}}">
                            {{$company->name}}
                        </option>
                        @endif
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">名前</label>
                    <select name="user_id" id="user_id" class="form-control" style="width:320px" ></select>
                </div>
                <div class="form-group form-inline">
                    <label for="date_from">受講期間（開始）</label>
                    <input type="date" class="form-control" name="date_from"
                        id="date_from"
                        value="{{ old('date_from') != null ? old('date_from') : $participant->date_from }}"
                        >
                    <label for="date_to">受講期間（終了）</label>
                    <input type="date" class="form-control" name="date_to"
                        id="date_to"
                        value="{{ old('date_to') != null ? old('date_to') : $participant->date_to }}"
                        >
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/trainings/{{$participant->training_id}}/edit">キャンセル</a>
            </form>

        </div>
    </div>
</div>

<script>
$(function(){
    var callUsers = function(){
        $('#user_id').empty();
        $.getJSON('/admin/companies/api/participants?company_id=' + $('#company_id').val(),
          function(users){
              users.forEach(function(u){
                  $('#user_id').append($('<option>').val(u.id).text(u.name));
              });

              var $participantId = $("#ops-participant").data('participant-id');
              if($participantId != null){
                  $.each($('#user_id option'), function(i, e){
                      var $e = $(e);
                      if($e.val() == $participantId){
                          $e.attr('selected', 'selected');
                      }
                  });
              }
          }
        );
    }
    $('#company_id').change(callUsers);
    callUsers();
});
</script>
