<div class="container ops-main">
    <div class="row">
      <div class="col-md-12">
        <h2 class="ops-title">受講企業詳細</h2>
      </div>
    </div>

    @include('admin/message')

    <div class="row">
      <div class="col-md-12">
        <h3>受講企業詳細情報</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        @if($target == 'store')
        <form action="/admin/companies" method="post">
        @else
        <form action="/admin/companies/{{$company->id}}" method="post">
          <input type="hidden" name="_method" value="PATCH">
        @endif
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name">企業名</label>
            <input type="text" class="form-control" name="name" id="name"
                value="{{ old('name') != null ? old('name') : $company->name }}"
                placeholder="企業名">
          </div>
          <div class="form-group">
            <label for="url">企業ホームページURL</label>
            <input type="url" class="form-control" name="url" id="url"
                value="{{ old('url') != null ? old('url') : $company->url }}"
                placeholder="http://example.com">
          </div>
          <button type="submit" class="btn btn-default">保存</button>
          <a href="/admin/companies">戻る</a>
        </form>
      </div>
    </div>
</div>
