<div class="container ops-main">
    <div class="row">
        <div class="col-md-12">
        @if($user->type == \App\User::TYPE_PARTICIPANT)
            <h3 class="ops-title">受講者登録</h3>
        @else
            <h3 class="ops-title">人事担当者登録</h3>
        @endif
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

        @if($target == 'store')
            <form action="/admin/users" method="post">
        @else
            <form action="/admin/users/{{$user->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
        @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="type" value="{{ $user->type }}">
                <input type="hidden" name="company_id" value="{{ $user->company_id}}">
                <div class="form-group">
                    <label for="name">受講企業名</label>
                    <p>{{ $user->company->name}}</p>
                </div>
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ old('name') != null ? old('name') : $user->name }}"
                        placeholder="村山雅彦">
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="mail" class="form-control" name="email" id="email"
                        value="{{ old('email') != null ? old('email') : $user->email }}"
                        placeholder="murayama@kronos-jp.net">
                </div>
                <button type="submit" class="btn btn-default">保存</button>
                <a href="/admin/companies/{{$user->company_id}}/edit">戻る</a>
            </form>
        </div>
    </div>
</div>
