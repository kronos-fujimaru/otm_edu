<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">連絡事項</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
          @foreach($participant->communications as $communication)
          <div class="row">
          @if ($communication->user->isAdmin())
              <div class="col-md-10 col-md-offset-2">
                  <div class="bs-callout bs-callout-info">
                      <pre>{{$communication->comment}}</pre>
                  </div>
                  <div>
                    {{$communication->user->company->name}}：{{$communication->user->name}} {{$communication->created_at}}
                    <form action="/admin/communications/{{ $communication->id }}" method="post" style="display:inline">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                  </div>
              </div>
          </div>
          @else
             <div class="col-md-10 col-md-offset-1">
                  <div class="bs-callout bs-callout-warning">
                      <pre>{{$communication->comment}}</pre>
                  </div>
                  <div>
                    {{$communication->user->company->name}}：{{$communication->user->name}} {{$communication->created_at}}
                  </div>
            </div>
          </div>
          @endif
          @endforeach

          <div class="row">
              <div class="col-md-12">
                  <hr>
              </div>
          </div>

            <form action="/admin/communications" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{ $participant->id}}">
                <div class="form-group">
                  <label for="comment">本文</label>
                  <textarea id="comment" name="comment"
                        class="form-control" style="height:200px">{{ old('comment') != null ? old('comment') : ''}}</textarea>
                </div>
                <button type="submit" class="btn btn-default">送信</button>
            </form>
        </div>
    </div>
</div>
