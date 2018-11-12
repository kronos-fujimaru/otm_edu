@if($target == 'store')
<div id="ops-manager" class="container ops-main">
@else
<div id="ops-manager" class="container ops-main"
    data-manager-id="{{$manager->user->id}}">
@endif
    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">人事担当者登録</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/managers" method="post">
        @else
            <form action="/admin/managers/{{$manager->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="training_id" value="{{ $manager->training_id}}">
                <div class="form-group">
                    <label for="company_id">受講企業名</label>
                    <select name="company_id" id="company_id" class="form-control" style="width:320px" >
                    @foreach ($companies as $company)
                        @if($manager->user != null && $company->id == $manager->user->company->id)
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
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/trainings/{{$manager->training_id}}/edit">キャンセル</a>
            </form>

        </div>
    </div>
</div>

<script>
$(function(){
    var callUsers = function(){
        $('#user_id').empty();
        $.getJSON('/admin/companies/api/managers?company_id=' + $('#company_id').val(),
          function(users){
              users.forEach(function(u){
                  $('#user_id').append($('<option>').val(u.id).text(u.name));
              });

              var $managerId = $("#ops-manager").data('manager-id');
              if($managerId != null){
                  $.each($('#user_id option'), function(i, e){
                      var $e = $(e);
                      if($e.val() == $managerId){
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
